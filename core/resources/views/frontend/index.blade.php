@extends('frontend.app')

@section('content')

<!-- Landing Page -->
    <div class="landing-page" id="landingPage">
        
        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <h1>Welcome to ChatBox</h1>
                <p>
                    ChatBox is a modern social messaging platform designed to connect people instantly.
                    Fast, secure, and simple communication for everyone.
                </p>

                <a href="#" class="btn-primary-custom" id="getStartedBtn">
                    <i class="bi bi-box-arrow-in-right"></i> Get Started
                </a>
            </div>
        </section>

        <!-- Features -->
        <section class="features">
            <div class="container">
                <div class="row g-4">

                    <div class="col-md-4">
                        <div class="feature-card text-center">
                            <i class="bi bi-lightning-charge"></i>
                            <h5>Fast Messaging</h5>
                            <p>Send and receive messages instantly with high speed performance.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="feature-card text-center">
                            <i class="bi bi-shield-lock"></i>
                            <h5>Secure Chat</h5>
                            <p>Your messages are protected with modern security standards.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="feature-card text-center">
                            <i class="bi bi-people"></i>
                            <h5>Connect People</h5>
                            <p>Build connections and stay in touch with friends easily.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- About -->
        <section class="about">
            <div class="container">
                <h2>About ChatBox</h2>
                <p>
                    ChatBox is a lightweight and modern messaging platform focused on simplicity and speed.
                    It helps users communicate in real-time with a clean and distraction-free interface.
                </p>
            </div>
        </section>

    </div>

    <script>
        let activeUserId = null;

        // DOM Elements
        const landingPage = document.getElementById('landingPage');
        const chatContainer = document.getElementById('chatContainer');
        const getStartedBtn = document.getElementById('getStartedBtn');
        const usersList = document.getElementById('usersList');
        const welcomeScreen = document.getElementById('welcomeScreen');
        const chatHeader = document.getElementById('chatHeader');
        const messagesArea = document.getElementById('messagesArea');
        const messageInputContainer = document.getElementById('messageInputContainer');
        const messageInput = document.getElementById('messageInput');
        const sendBtn = document.getElementById('sendBtn');
        const searchInput = document.getElementById('searchInput');

        // Show Chat Interface
        getStartedBtn.addEventListener('click', (e) => {
            e.preventDefault();
            landingPage.style.display = 'none';
            chatContainer.classList.add('active');
            populateUsersList();
        });

        // Populate Users List
        function populateUsersList(filter = '') {
            usersList.innerHTML = '';
            const filteredUsers = users.filter(user => 
                user.name.toLowerCase().includes(filter.toLowerCase())
            );

            filteredUsers.forEach(user => {
                const userItem = document.createElement('div');
                userItem.className = 'user-item';
                if (activeUserId === user.id) {
                    userItem.classList.add('active');
                }
                
                userItem.innerHTML = `
                    <div class="user-avatar ${user.online ? 'online' : ''}">${user.avatar}</div>
                    <div class="user-info">
                        <div class="user-name">${user.name}</div>
                        <div class="user-status">${user.status}</div>
                    </div>
                    <div style="text-align: right;">
                        <div class="message-time">${user.time}</div>
                        ${user.unread > 0 ? `<div class="unread-badge">${user.unread}</div>` : ''}
                    </div>
                `;

                userItem.addEventListener('click', (e) => openChat(user, e));
                usersList.appendChild(userItem);
            });
        }

        // Search Functionality
        searchInput.addEventListener('input', (e) => {
            populateUsersList(e.target.value);
        });

        // Open Chat
        function openChat(user, event) {
            activeUserId = user.id;
            
            // Update UI
            welcomeScreen.style.display = 'none';
            chatHeader.style.display = 'flex';
            messagesArea.style.display = 'block';
            messageInputContainer.style.display = 'block';

            // Update active user in sidebar
            document.querySelectorAll('.user-item').forEach(item => {
                item.classList.remove('active');
            });
            if (event && event.currentTarget) {
                event.currentTarget.classList.add('active');
            }

            // Update chat header
            document.getElementById('activeUserAvatar').textContent = user.avatar;
            document.getElementById('activeUserAvatar').className = `user-avatar ${user.online ? 'online' : ''}`;
            document.getElementById('activeUserName').textContent = user.name;
            document.getElementById('activeUserStatus').textContent = user.online ? 'Online' : 'Offline';

            // Load messages
            loadMessages(user.id);

            // Clear unread badge
            user.unread = 0;
            populateUsersList();
        }

        // Load Messages
        function loadMessages(userId) {
            messagesArea.innerHTML = '';

            // Add date separator
            const dateSeparator = document.createElement('div');
            dateSeparator.className = 'date-separator';
            dateSeparator.innerHTML = '<span>Today</span>';
            messagesArea.appendChild(dateSeparator);

            const messages = messagesData[userId] || [];
            messages.forEach(msg => {
                addMessageToUI(msg.type, msg.text, msg.time);
            });

            // Scroll to bottom
            messagesArea.scrollTop = messagesArea.scrollHeight;
        }

        // Add Message to UI
        function addMessageToUI(type, text, time) {
            const message = document.createElement('div');
            message.className = `message ${type}`;
            
            message.innerHTML = `
                <div class="message-content">
                    <div class="message-bubble">
                        <div class="message-text">${text}</div>
                    </div>
                    <div class="message-meta">
                        <span>${time}</span>
                        ${type === 'sent' ? '<i class="bi bi-check2-all"></i>' : ''}
                    </div>
                </div>
            `;

            messagesArea.appendChild(message);
            messagesArea.scrollTop = messagesArea.scrollHeight;
        }

        // Send Message
        function sendMessage() {
            const text = messageInput.value.trim();
            if (text === '' || activeUserId === null) return;

            const now = new Date();
            const time = now.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });

            // Add message to UI
            addMessageToUI('sent', text, time);

            // Save to messages data
            if (!messagesData[activeUserId]) {
                messagesData[activeUserId] = [];
            }
            messagesData[activeUserId].push({ type: 'sent', text, time });

            // Clear input
            messageInput.value = '';
            messageInput.style.height = 'auto';

            // Simulate typing indicator
            showTypingIndicator();

            // Simulate reply after 2 seconds
            setTimeout(() => {
                hideTypingIndicator();
                simulateReply();
            }, 2000);
        }

        // Typing Indicator
        function showTypingIndicator() {
            const typingDiv = document.createElement('div');
            typingDiv.className = 'typing-indicator active';
            typingDiv.id = 'typingIndicator';
            typingDiv.innerHTML = `
                <div class="typing-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            `;
            messagesArea.appendChild(typingDiv);
            messagesArea.scrollTop = messagesArea.scrollHeight;
        }

        function hideTypingIndicator() {
            const typingIndicator = document.getElementById('typingIndicator');
            if (typingIndicator) {
                typingIndicator.remove();
            }
        }

        // Simulate Reply
        function simulateReply() {
            const replies = [
                "That's great!",
                "Thanks for letting me know!",
                "Sounds good to me!",
                "I appreciate it!",
                "Perfect! 👍"
            ];

            const randomReply = replies[Math.floor(Math.random() * replies.length)];
            const now = new Date();
            const time = now.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });

            addMessageToUI('received', randomReply, time);

            if (!messagesData[activeUserId]) {
                messagesData[activeUserId] = [];
            }
            messagesData[activeUserId].push({ type: 'received', text: randomReply, time });
        }

        // Event Listeners
        sendBtn.addEventListener('click', sendMessage);

        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        // Auto-resize textarea
        messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        // Initialize
        populateUsersList();
    </script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    

@endsection
