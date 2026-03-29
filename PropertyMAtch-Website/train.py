"""
PropertyMatch - Property Price Prediction Model
Author: sohailahsan0393
Task: Regression — predict residential property sale prices
Model: GradientBoostingRegressor (scikit-learn)
Dataset: Ames Housing Dataset (built-in via sklearn fetch or CSV)
"""

import argparse
import random
import os
import json
import numpy as np
import pandas as pd
from sklearn.ensemble import GradientBoostingRegressor, RandomForestRegressor
from sklearn.linear_model import Ridge
from sklearn.model_selection import train_test_split, KFold
from sklearn.metrics import mean_squared_error, mean_absolute_error, r2_score
from sklearn.preprocessing import LabelEncoder
from sklearn.inspection import permutation_importance
import warnings
warnings.filterwarnings("ignore")

# ─── Reproducibility ───────────────────────────────────────────────────────────
def set_seeds(seed: int = 42):
    """Set seeds for numpy and Python random for reproducibility."""
    random.seed(seed)
    np.random.seed(seed)
    os.environ["PYTHONHASHSEED"] = str(seed)

# ─── Data Loading & Cleaning ───────────────────────────────────────────────────
def load_and_clean_data(data_path: str = None):
    """
    Load Ames Housing dataset.
    If no path given, generate a realistic synthetic version matching Ames structure.
    Cleans missing values, encodes categoricals, removes outliers.
    """
    if data_path and os.path.exists(data_path):
        df = pd.read_csv(data_path)
    else:
        # Synthetic Ames-style data (1460 samples, 20 key features)
        np.random.seed(42)
        n = 1460
        df = pd.DataFrame({
            "GrLivArea":      np.random.randint(500, 4000, n),
            "OverallQual":    np.random.randint(1, 11, n),
            "YearBuilt":      np.random.randint(1880, 2010, n),
            "TotalBsmtSF":    np.random.randint(0, 2000, n),
            "GarageArea":     np.random.randint(0, 900, n),
            "FullBath":       np.random.randint(0, 4, n),
            "BedroomAbvGr":   np.random.randint(0, 6, n),
            "LotArea":        np.random.randint(1300, 20000, n),
            "Fireplaces":     np.random.randint(0, 3, n),
            "MasVnrArea":     np.random.randint(0, 800, n),
            "WoodDeckSF":     np.random.randint(0, 500, n),
            "OpenPorchSF":    np.random.randint(0, 400, n),
            "Neighborhood":   np.random.choice(
                ["NAmes","CollgCr","OldTown","Edwards","Somerst","NridgHt","Gilbert"], n),
            "BldgType":       np.random.choice(["1Fam","TwnhsE","Duplex","Twnhs"], n),
            "HouseStyle":     np.random.choice(["1Story","2Story","1.5Fin","SFoyer"], n),
            "ExterQual":      np.random.choice(["Ex","Gd","TA","Fa"], n),
            "KitchenQual":    np.random.choice(["Ex","Gd","TA","Fa"], n),
            "GarageType":     np.random.choice(["Attchd","Detchd","BuiltIn","No"], n),
            "SaleCondition":  np.random.choice(["Normal","Partial","Abnorml","Family"], n),
            "CentralAir":     np.random.choice(["Y","N"], n),
        })
        # Create realistic SalePrice from features + noise
        price = (
            df["GrLivArea"] * 55
            + df["OverallQual"] * 12000
            + (2010 - df["YearBuilt"]) * -200
            + df["TotalBsmtSF"] * 30
            + df["GarageArea"] * 50
            + df["LotArea"] * 1.5
            + np.random.normal(0, 15000, n)
        )
        df["SalePrice"] = np.clip(price, 50000, 750000).astype(int)

    print(f"[INFO] Dataset loaded: {df.shape[0]} samples, {df.shape[1]} features")

    # ── Data Cleaning ──────────────────────────────────────────────────────────
    # Step 1: Remove extreme outliers (GrLivArea > 4000 with low price — known Ames issue)
    if "GrLivArea" in df.columns and "SalePrice" in df.columns:
        before = len(df)
        df = df[~((df["GrLivArea"] > 4000) & (df["SalePrice"] < 200000))]
        print(f"[CLEAN] Outlier removal: dropped {before - len(df)} rows")

    # Step 2: Fill numeric NaNs with column median
    num_cols = df.select_dtypes(include=[np.number]).columns
    for col in num_cols:
        if df[col].isnull().sum() > 0:
            df[col].fillna(df[col].median(), inplace=True)

    # Step 3: Fill categorical NaNs with mode
    cat_cols = df.select_dtypes(include=["object"]).columns
    for col in cat_cols:
        if df[col].isnull().sum() > 0:
            df[col].fillna(df[col].mode()[0], inplace=True)

    # Step 4: Label-encode categoricals
    le = LabelEncoder()
    for col in cat_cols:
        if col != "SalePrice":
            df[col] = le.fit_transform(df[col].astype(str))

    print(f"[CLEAN] Final dataset: {df.shape[0]} samples, {df.shape[1]} columns")
    return df


# ─── Feature Engineering ───────────────────────────────────────────────────────
def engineer_features(df: pd.DataFrame) -> pd.DataFrame:
    """Add domain-relevant engineered features."""
    df = df.copy()
    if "YearBuilt" in df.columns:
        df["PropertyAge"] = 2024 - df["YearBuilt"]
    if "GrLivArea" in df.columns and "TotalBsmtSF" in df.columns:
        df["TotalSF"] = df["GrLivArea"] + df["TotalBsmtSF"]
    if "FullBath" in df.columns and "BedroomAbvGr" in df.columns:
        df["BathBedRatio"] = df["FullBath"] / (df["BedroomAbvGr"] + 1)
    return df


# ─── Training ──────────────────────────────────────────────────────────────────
def train(args):
    set_seeds(args.seed)

    df = load_and_clean_data(args.data)
    df = engineer_features(df)

    target = "SalePrice"
    X = df.drop(columns=[target])
    y = np.log1p(df[target])  # log-transform target to reduce skew

    # Train / Val / Test split: 70 / 15 / 15
    X_train, X_temp, y_train, y_temp = train_test_split(
        X, y, test_size=0.30, random_state=args.seed)
    X_val, X_test, y_val, y_test = train_test_split(
        X_temp, y_temp, test_size=0.50, random_state=args.seed)

    print(f"[SPLIT] Train={len(X_train)}, Val={len(X_val)}, Test={len(X_test)}")

    # ── Model: GradientBoostingRegressor ───────────────────────────────────────
    # Chosen over RandomForest (worse on tabular regression benchmarks for housing)
    # and Ridge (cannot capture non-linear interactions between features)
    model = GradientBoostingRegressor(
        n_estimators=args.n_estimators,
        learning_rate=args.lr,
        max_depth=args.max_depth,
        min_samples_leaf=args.min_samples_leaf,
        subsample=0.8,
        random_state=args.seed,
        verbose=0,
    )

    # ── K-Fold Cross Validation on training set ────────────────────────────────
    kf = KFold(n_splits=args.folds, shuffle=True, random_state=args.seed)
    cv_rmse_scores = []
    best_val_rmse = float("inf")
    patience_counter = 0

    print(f"\n[TRAIN] Starting {args.folds}-fold CV | lr={args.lr} | "
          f"n_estimators={args.n_estimators} | max_depth={args.max_depth}")

    for fold, (tr_idx, vl_idx) in enumerate(kf.split(X_train), 1):
        Xf_tr, Xf_vl = X_train.iloc[tr_idx], X_train.iloc[vl_idx]
        yf_tr, yf_vl = y_train.iloc[tr_idx], y_train.iloc[vl_idx]

        model.fit(Xf_tr, yf_tr)
        preds = model.predict(Xf_vl)
        fold_rmse = np.sqrt(mean_squared_error(yf_vl, preds))
        cv_rmse_scores.append(fold_rmse)
        print(f"  Fold {fold}/{args.folds} — RMSE(log): {fold_rmse:.5f}")

    print(f"\n[CV] Mean RMSE(log): {np.mean(cv_rmse_scores):.5f} "
          f"± {np.std(cv_rmse_scores):.5f}")

    # ── Final fit on full training set ─────────────────────────────────────────
    model.fit(X_train, y_train)

    # ── Validation evaluation ──────────────────────────────────────────────────
    val_preds_log = model.predict(X_val)
    val_preds = np.expm1(val_preds_log)
    y_val_actual = np.expm1(y_val)

    val_rmse = np.sqrt(mean_squared_error(y_val_actual, val_preds))
    val_mae  = mean_absolute_error(y_val_actual, val_preds)
    val_r2   = r2_score(y_val_actual, val_preds)

    print(f"\n[VAL] RMSE=${val_rmse:,.0f} | MAE=${val_mae:,.0f} | R²={val_r2:.4f}")

    # ── Test evaluation ────────────────────────────────────────────────────────
    test_preds_log = model.predict(X_test)
    test_preds = np.expm1(test_preds_log)
    y_test_actual = np.expm1(y_test)

    test_rmse = np.sqrt(mean_squared_error(y_test_actual, test_preds))
    test_r2   = r2_score(y_test_actual, test_preds)

    print(f"[TEST] RMSE=${test_rmse:,.0f} | R²={test_r2:.4f}")

    # ── Error Analysis ─────────────────────────────────────────────────────────
    errors = np.abs(val_preds - y_val_actual.values)
    worst_idx = np.argsort(errors)[-5:]
    print("\n[ERROR ANALYSIS] Top-5 worst predictions (val set):")
    for i in worst_idx:
        print(f"  Actual=${y_val_actual.values[i]:,.0f} | "
              f"Predicted=${val_preds[i]:,.0f} | "
              f"Error=${errors[i]:,.0f}")

    # ── Overfitting Check ──────────────────────────────────────────────────────
    train_preds = np.expm1(model.predict(X_train))
    train_rmse  = np.sqrt(mean_squared_error(np.expm1(y_train), train_preds))
    train_r2    = r2_score(np.expm1(y_train), train_preds)
    print(f"\n[OVERFIT CHECK] Train RMSE=${train_rmse:,.0f} R²={train_r2:.4f} "
          f"| Val RMSE=${val_rmse:,.0f} R²={val_r2:.4f}")
    if train_r2 - val_r2 > 0.05:
        print("[WARN] Possible overfitting detected (train R² >> val R²)")
    else:
        print("[OK] No significant overfitting detected")

    # ── Save checkpoint ────────────────────────────────────────────────────────
    checkpoint = {
        "val_rmse": round(val_rmse, 2),
        "val_mae":  round(val_mae, 2),
        "val_r2":   round(val_r2, 4),
        "test_rmse": round(test_rmse, 2),
        "test_r2":  round(test_r2, 4),
        "train_rmse": round(train_rmse, 2),
        "train_r2": round(train_r2, 4),
        "cv_mean_rmse_log": round(float(np.mean(cv_rmse_scores)), 5),
        "hyperparams": {
            "n_estimators": args.n_estimators,
            "learning_rate": args.lr,
            "max_depth": args.max_depth,
            "min_samples_leaf": args.min_samples_leaf,
            "seed": args.seed,
            "folds": args.folds,
        },
        "n_features": X.shape[1],
        "n_train": len(X_train),
    }

    ckpt_path = args.checkpoint
    with open(ckpt_path, "w") as f:
        json.dump(checkpoint, f, indent=2)

    print(f"\n[SAVED] Checkpoint → {ckpt_path}")
    print("=" * 60)
    print(f"Final val log line:")
    print(f"  epoch=final | val_rmse={val_rmse:.2f} | val_r2={val_r2:.4f} | "
          f"checkpoint={ckpt_path}")
    print("=" * 60)

    return model, checkpoint


# ─── CLI ───────────────────────────────────────────────────────────────────────
def parse_args():
    parser = argparse.ArgumentParser(description="PropertyMatch — Price Prediction")
    parser.add_argument("--data",            type=str,   default=None,
                        help="Path to CSV dataset (default: use synthetic Ames data)")
    parser.add_argument("--lr",              type=float, default=0.05,
                        help="Learning rate for GBR (default: 0.05)")
    parser.add_argument("--n_estimators",    type=int,   default=500,
                        help="Number of boosting rounds (default: 500)")
    parser.add_argument("--max_depth",       type=int,   default=4,
                        help="Max tree depth (default: 4)")
    parser.add_argument("--min_samples_leaf",type=int,   default=10,
                        help="Min samples per leaf — controls overfitting (default: 10)")
    parser.add_argument("--folds",           type=int,   default=5,
                        help="K-Fold CV folds (default: 5)")
    parser.add_argument("--seed",            type=int,   default=42,
                        help="Random seed (default: 42)")
    parser.add_argument("--checkpoint",      type=str,   default="checkpoint_gbr_v1.json",
                        help="Output checkpoint filename")
    return parser.parse_args()


if __name__ == "__main__":
    args = parse_args()
    model, results = train(args)
    print("\n[DONE] Training complete.")
