let inactivityTimeout;

function resetInactivityTimeout() {
    clearTimeout(inactivityTimeout);
    inactivityTimeout = setTimeout(() => {
        window.location.href = 'leaderboard.php';
    }, 60000); // 1 minute
}

// Reset the timeout on any user interaction
window.onload = resetInactivityTimeout;
document.onmousemove = resetInactivityTimeout;
document.onkeypress = resetInactivityTimeout;
document.ontouchstart = resetInactivityTimeout;
document.onclick = resetInactivityTimeout;