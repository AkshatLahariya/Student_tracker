import React, { useState } from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import Navigation from '../components/Navigation';
import LoginForm from '../components/LoginForm';

const Home = () => {
  const [userType, setUserType] = useState(null);

  const handleLogin = (type) => {
    setUserType(type);
  };

  return (
    <Router>
      <div>
        <Navigation />
        <Switch>
          <Route exact path="/">
            {!userType ? <LoginForm onLogin={handleLogin} /> : null}
          </Route>
          {/* Add routes for admin, faculty, and student dashboards */}
        </Switch>
      </div>
    </Router>
  );
};

export default Home;
