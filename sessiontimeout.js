let timeout;

    function resetTimeout() {
      clearTimeout(timeout);
      timeout = setTimeout(logout, 300000); // 300000 ms = 5 minutes
    }

    function logout() {
      alert('You have been logged out due to inactivity.');
      window.location.href = 'login.html'; // Redirect to login page
    }

    document.addEventListener('mousemove', resetTimeout);
    document.addEventListener('keydown', resetTimeout);
    document.addEventListener('click', resetTimeout);
    document.addEventListener('scroll', resetTimeout);

    resetTimeout(); // Initialize the timeout when the page loads