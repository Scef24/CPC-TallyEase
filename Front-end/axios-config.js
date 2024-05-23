import axios from 'axios';

// Create an instance of axios with default configuration
const instance = axios.create({
  baseURL: 'http://127.0.0.1:8000', // Set your base URL here
  timeout: 5000, 
  headers: {
    'Content-Type': 'multipart/form-data', // Set default content type
    'Accept': 'application/json'
  }
});

export default instance;