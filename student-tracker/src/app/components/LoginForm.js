import React, { useState } from 'react';
import './LoginForm.css'; // Create a separate CSS file for styling

const LoginForm = () => {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [emailInfo, setEmailInfo] = useState('');
  const [passwordInfo, setPasswordInfo] = useState('');
  const [confirmationMessage, setConfirmationMessage] = useState('');
  const [isSignUp, setIsSignUp] = useState(true);

  const validatePassword = () => {
    const passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*[0-9]).{8,}$/;
    if (!passwordRegex.test(password)) {
      setPasswordInfo("Password must contain a capital letter, a symbol, and a number.");
      return false;
    } else {
      setPasswordInfo("");
      return true;
    }
  };

  const validateEmail = () => {
    const emailRegex = /@mitwpu\.edu\.in$/;
    if (!emailRegex.test(email)) {
      setEmailInfo("Invalid email address. Please use a valid email ending with @mitwpu.edu.in.");
      return false;
    } else {
      setEmailInfo("");
      return true;
    }
  };

  const handleSignIn = () => {
    if (email && password) {
      // Redirect to student dashboard
      window.location.href = "stu_dashboard.html";
    } else {
      setIsSignUp(false);
    }
  };

  const handleSignUp = () => {
    if (name && email && password) {
      if (validatePassword() && validateEmail()) {
        setConfirmationMessage("Your request has been sent to the admin for confirmation.");
      }
    } else {
      setIsSignUp(true);
    }
  };

  return (
    <div className="container">
      <div className="form-box">
        <h2 id="title">{isSignUp ? 'Sign Up' : 'Sign In'}</h2>
        <form id="signupForm">
          {isSignUp && (
            <div className="input-field" id="nameField">
              <i className="fa-solid fa-user"></i>
              <input
                type="text"
                placeholder="Name"
                value={name}
                onChange={(e) => setName(e.target.value)}
              />
            </div>
          )}
          <div className="input-field">
            <i className="fa-solid fa-envelope"></i>
            <input
              type="email"
              placeholder="Email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
            />
            <p id="emailInfo">{emailInfo}</p>
          </div>
          <div className="input-field">
            <i className="fa-solid fa-lock"></i>
            <input
              type="password"
              placeholder="Password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
            />
            <p id="passwordInfo">{passwordInfo}</p>
          </div>
          <p>Lost password <a href="#">Click Here!</a></p>
          <div className="btn-field">
            <button type="button" onClick={handleSignUp}>
              Sign Up
            </button>
            <button type="button" onClick={handleSignIn} className={!isSignUp ? 'disable' : ''}>
              Sign In
            </button>
          </div>
        </form>
        <p id="confirmationMessage" style={{ display: confirmationMessage ? 'block' : 'none' }}>
          {confirmationMessage}
        </p>
      </div>
    </div>
  );
};

export default LoginForm;
