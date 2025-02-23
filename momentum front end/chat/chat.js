// public/js/chat.js

const socket = new WebSocket('ws://localhost:9000/chat');

socket.onmessage = (event) => {
  console.log(`Received message: ${event.data}`);
  // Update the chat log with the new message
};

socket.onopen = () => {
  console.log('Connected to the WebSocket server');
  // Send a message to the server to initiate the conversation
};

socket.onerror = (error) => {
  console.log(`Error occurred: ${error}`);
};

socket.onclose = () => {
  console.log('Disconnected from the WebSocket server');
};

// Send a message to the server when the user submits the chat form
document.getElementById('chat-form').addEventListener('submit', (event) => {
  event.preventDefault();
  const message = document.getElementById('message-input').value;
  socket.send(message);
});