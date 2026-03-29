// Mock FAQ data
const faqData = [
    {
        question: "What is PropertyMatch and how does it work?",
        answer: "PropertyMatch is an AI-powered platform that helps you find your perfect property by matching your preferences with available listings. Simply tell us what you're looking for, and our intelligent system will provide personalized recommendations."
    },
    {
        question: "How do I search for properties on PropertyMatch?",
        answer: "You can search by location, price range, property type, number of bedrooms, and many other criteria. Our advanced filters help you narrow down options to find exactly what you need."
    },
    {
        question: "What types of properties are available?",
        answer: "We offer a wide range of properties including apartments, houses, condos, townhouses, and commercial spaces for both rent and purchase across various price ranges."
    },
    {
        question: "How accurate are the property listings?",
        answer: "Our listings are updated in real-time and verified by our team. We work directly with property owners and agents to ensure all information is current and accurate."
    },
    {
        question: "Can I schedule property viewings through PropertyMatch?",
        answer: "Yes! You can easily schedule viewings directly through our platform. Simply click on any property listing and select your preferred viewing time."
    },
    {
        question: "What are your fees and pricing?",
        answer: "PropertyMatch offers competitive pricing with transparent fees. For buyers, our service is completely free. For sellers and landlords, we charge a small commission only when your property is successfully matched."
    },
    {
        question: "How do I contact support?",
        answer: "You can reach our support team 24/7 through this chat, email us at support@propertymatch.com, or call us at 1-800-PROPERTY. We're always here to help!"
    }
];

// DOM elements
const chatbotIcon = document.getElementById('chatbot-icon');
const chatbotContainer = document.getElementById('chatbot-container');
const closeBtn = document.getElementById('close-btn');
const sendBtn = document.getElementById('send-btn');
const chatbotInput = document.getElementById('chatbot-input');
const messagesContainer = document.getElementById('chatbot-messages');
const typingIndicator = document.getElementById('typing-indicator');

// State
let messageId = 0;

// Initialize chatbot
document.addEventListener('DOMContentLoaded', function() {
    setupEventListeners();
    updateSendButton();
});

function setupEventListeners() {
    // Icon click to open chatbot
    chatbotIcon.addEventListener('click', openChatbot);
    
    // Close button
    closeBtn.addEventListener('click', closeChatbot);
    
    // Send button
    sendBtn.addEventListener('click', sendMessage);
    
    // Enter key to send message
    chatbotInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });
    
    // Input changes
    chatbotInput.addEventListener('input', updateSendButton);
    
    // Close on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !chatbotContainer.classList.contains('hidden')) {
            closeChatbot();
        }
    });
}

function openChatbot() {
    chatbotContainer.classList.remove('hidden');
    chatbotIcon.style.display = 'none';
    
    // Trigger animation
    setTimeout(() => {
        chatbotContainer.classList.add('show');
    }, 10);
    
    // Focus input
    setTimeout(() => {
        chatbotInput.focus();
    }, 400);
}

function closeChatbot() {
    chatbotContainer.classList.remove('show');
    
    setTimeout(() => {
        chatbotContainer.classList.add('hidden');
        chatbotIcon.style.display = 'flex';
    }, 400);
}

function updateSendButton() {
    const hasText = chatbotInput.value.trim().length > 0;
    sendBtn.disabled = !hasText;
}

async function sendMessage() {
    const userMessage = chatbotInput.value.trim();
    if (!userMessage) return;
    
    // Add user message
    appendMessage('user', userMessage);
    
    // Clear input
    chatbotInput.value = '';
    updateSendButton();
    
    // Show typing indicator
    showTypingIndicator();
    
    // Get bot response
    setTimeout(async () => {
        hideTypingIndicator();
        
        const context = getRelevantAnswer(userMessage);
        let botResponse;
        
        if (context) {
            botResponse = context;
        } else {
            // Try to get AI response (if API is available)
            botResponse = await getBotResponse(userMessage) || getDefaultResponse(userMessage);
        }
        
        appendMessage('bot', botResponse);
    }, 1000 + Math.random() * 1000); // Random delay for more natural feel
}

function appendMessage(sender, message) {
    const messageElement = document.createElement('div');
    messageElement.className = `message ${sender}`;
    messageElement.innerHTML = `
        <div class="message-avatar">
            ${sender === 'bot' ? 
                `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <circle cx="12" cy="5" r="2"/>
                    <path d="M12 7v4"/>
                    <line x1="8" y1="16" x2="8" y2="16"/>
                    <line x1="16" y1="16" x2="16" y2="16"/>
                </svg>` :
                `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>`
            }
        </div>
        <div class="message-content">
            <div class="message-text">${message}</div>
            <div class="message-time">${formatTime(new Date())}</div>
        </div>
    `;
    
    messagesContainer.appendChild(messageElement);
    scrollToBottom();
}

function showTypingIndicator() {
    typingIndicator.classList.remove('hidden');
    scrollToBottom();
}

function hideTypingIndicator() {
    typingIndicator.classList.add('hidden');
}

function scrollToBottom() {
    setTimeout(() => {
        const chatBody = document.querySelector('.chatbot-body');
        chatBody.scrollTop = chatBody.scrollHeight;
    }, 100);
}

function formatTime(date) {
    return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
}

function getRelevantAnswer(userMessage) {
    const lowerCaseMessage = userMessage.toLowerCase();
    
    // Simple keyword matching
    for (let item of faqData) {
        const keywords = item.question.toLowerCase().split(/\s+/);
        let matchScore = 0;
        
        for (let word of keywords) {
            if (word.length > 3 && lowerCaseMessage.includes(word)) {
                matchScore++;
            }
        }
        
        // Also check for direct keyword matches
        const directKeywords = {
            'search': 'How do I search for properties on PropertyMatch?',
            'types': 'What types of properties are available?',
            'pricing': 'What are your fees and pricing?',
            'fees': 'What are your fees and pricing?',
            'cost': 'What are your fees and pricing?',
            'viewing': 'Can I schedule property viewings through PropertyMatch?',
            'schedule': 'Can I schedule property viewings through PropertyMatch?',
            'support': 'How do I contact support?',
            'contact': 'How do I contact support?',
            'help': 'How do I contact support?',
            'accurate': 'How accurate are the property listings?',
            'listings': 'How accurate are the property listings?'
        };
        
        for (let keyword in directKeywords) {
            if (lowerCaseMessage.includes(keyword)) {
                const matchedQuestion = directKeywords[keyword];
                const matchedItem = faqData.find(item => item.question === matchedQuestion);
                if (matchedItem) {
                    return matchedItem.answer;
                }
            }
        }
        
        if (matchScore >= 2) {
            return item.answer;
        }
    }
    
    return null;
}

function getDefaultResponse(userMessage) {
    const responses = [
        "I'd be happy to help you with that! PropertyMatch specializes in connecting you with the perfect property. Could you tell me more about what you're looking for?",
        "That's a great question! Our team can provide more detailed information about that. You can also browse our extensive property database to find exactly what you need.",
        "Thanks for reaching out! PropertyMatch offers comprehensive property services. Is there a specific type of property or location you're interested in?",
        "I understand you're looking for information. Our platform has helped thousands find their ideal properties. What specific details would be most helpful for you?",
        "Great question! PropertyMatch uses advanced matching algorithms to connect buyers and renters with perfect properties. Would you like to know more about our services?"
    ];
    
    return responses[Math.floor(Math.random() * responses.length)];
}

async function getBotResponse(userMessage) {
    // This function can be used to integrate with external APIs
    // For now, it returns null to fall back to default responses
    //AIzaSyCjaG-Jook2EwjuwGSA-zVo8ezIEOuF-Ik
  // Example API integration:
    try {
        const API_KEY = "AIzaSyCjaG-Jook2EwjuwGSA-zVo8ezIEOuF-Ik";
        const API_URL = `https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=${API_KEY}`;
        
        const context = getRelevantAnswer(userMessage) || "You are a helpful PropertyMatch assistant.";
        const fullPrompt = `${context}\nUser: ${userMessage}\nAssistant:`;
        
        const response = await fetch(API_URL, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                contents: [{ parts: [{ text: fullPrompt }] }]
            })
        });
        
        const data = await response.json();
        return data?.candidates?.[0]?.content?.parts?.[0]?.text;
    } catch (error) {
        console.error("API Error:", error);
        return null;
    }
    
    
    return null;
}

// Add some interactive features
function addQuickReplies() {
    const quickReplies = [
        "Show me apartments",
        "What's your pricing?",
        "Schedule a viewing",
        "Contact support"
    ];
    
    // This could be implemented to show quick reply buttons
    // after the welcome message or when the user seems stuck
}

// Add smooth scrolling and better UX
function enhanceUserExperience() {
    // Add smooth scrolling
    const style = document.createElement('style');
    style.textContent = `
        .chatbot-body {
            scroll-behavior: smooth;
        }
    `;
    document.head.appendChild(style);
}

// Initialize enhancements
enhanceUserExperience();