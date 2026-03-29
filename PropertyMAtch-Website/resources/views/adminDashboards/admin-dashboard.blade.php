<x-layout >
    <style>
        .dashboard-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: 1rem;
            background-color: #fff;
        }

        .dashboard-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.08);
        }

        .icon-circle {
            width: 50px;
            height: 50px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <div class="main-container" style="  background-color: #f9f9ff;">
        <x-AdminSidebar/>

        <div class="content" id="content">
            {{--            --------------------}}

            <div id="main-container">

                {{--                ------------------------------------------------}}




                <div class="row g-4 mt-5">
                    <!-- Total Properties -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card dashboard-card border-0 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="icon-circle bg-primary text-white me-3">
                                    <i class="bi bi-building fs-4"></i>
                                </div>
                                <div>
                                    <p class="mb-1 text-muted fw-semibold">Total Properties</p>
                                    <h4 class="fw-bold mb-0 text-dark"> {{ $AllCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- My Properties -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card dashboard-card border-0 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="icon-circle bg-success text-white me-3">
                                    <i class="bi bi-house-door fs-4"></i>
                                </div>
                                <div>
                                    <p class="mb-1 text-muted fw-semibold"> Active Properties</p>
                                    <h4 class="fw-bold mb-0 text-dark">{{ $ActiveCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sold Properties -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card dashboard-card border-0 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="icon-circle bg-danger text-white me-3">
                                    <i class="bi bi-check-circle fs-4"></i>
                                </div>
                                <div>
                                    <p class="mb-1 text-muted fw-semibold">Pending Properties</p>
                                    <h4 class="fw-bold mb-0 text-dark">{{ $PendingCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>







                {{--            --------------------}}

            </div>

        </div>
    </div>
</x-layout>
