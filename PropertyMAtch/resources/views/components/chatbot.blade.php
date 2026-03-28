<!-- Chatbot Icon -->
<div id="chatbot-icon" class="chatbot-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bot-icon lucide-bot"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
      
    <div class="pulse-ring"></div>
</div>

<!-- Chatbot Container -->
<div id="chatbot-container" class="chatbot-container hidden">
    <!-- Header -->
    <div class="chatbot-header">
        <div class="header-content">
            <div class="bot-avatar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                    <circle cx="12" cy="5" r="2" />
                    <path d="M12 7v4" />
                    <line x1="8" y1="16" x2="8" y2="16" />
                    <line x1="16" y1="16" x2="16" y2="16" />
                </svg>
            </div>
            <div class="header-text">
                <h3>PropertyMatch Assistant</h3>
                <span class="status">Online</span>
            </div>
        </div>
        <button id="close-btn" class="close-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
        </button>
    </div>

    <!-- Messages Area -->
    <div class="chatbot-body">
        <div id="chatbot-messages" class="messages-container">
            <!-- Welcome message -->
            <div class="message bot welcome-message">
                <div class="message-avatar">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                        <circle cx="12" cy="5" r="2" />
                        <path d="M12 7v4" />
                        <line x1="8" y1="16" x2="8" y2="16" />
                        <line x1="16" y1="16" x2="16" y2="16" />
                    </svg>
                </div>
                <div class="message-content">
                    <div class="message-text">
                        Hello! I'm your PropertyMatch assistant. I can help you find properties, answer questions
                        about our services, and guide you through the process. How can I assist you today?
                    </div>
                    <div class="message-time">Just now</div>
                </div>
            </div>
        </div>
        <div id="typing-indicator" class="typing-indicator hidden">
            <div class="typing-avatar">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                    <circle cx="12" cy="5" r="2" />
                    <path d="M12 7v4" />
                    <line x1="8" y1="16" x2="8" y2="16" />
                    <line x1="16" y1="16" x2="16" y2="16" />
                </svg>
            </div>
            <div class="typing-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <!-- Input Area -->
    <div class="chatbot-input-container">
        <div class="input-wrapper">
            <input type="text" id="chatbot-input" placeholder="Type your message..." autocomplete="off">
            <button id="send-btn" class="send-btn" disabled>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="22" y1="2" x2="11" y2="13" />
                    <polygon points="22,2 15,22 11,13 2,9" />
                </svg>
            </button>
        </div>
    </div>
</div>

<script src="{{asset('js/chatbot.js') }}"></script>
<link rel="stylesheet" href="{{asset('styles/chatbot.css') }}">
