import React from 'react';
import { Link } from 'react-router-dom';

const Navigation = () => {
  return (
    <nav>
      <ul>
        <li>
          <Link to="/">Home</Link>
        </li>
        <li>
          <Link to="/admin">Admin Dashboard</Link>
        </li>
        <li>
          <Link to="/faculty">Faculty Dashboard</Link>
        </li>
        <li>
          <Link to="/student">Student Dashboard</Link>
        </li>
      </ul>
    </nav>
  );
};

export default Navigation;
