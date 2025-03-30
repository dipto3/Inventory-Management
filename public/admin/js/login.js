function createParticles() {
    const particlesContainer = document.getElementById("particles");
    const particleCount = window.innerWidth < 576 ? 20 : 50;

    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement("div");
        particle.classList.add("particle");

        // Random size between 5px and 15px
        const size = Math.random() * 10 + 5;
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;

        // Random position
        particle.style.left = `${Math.random() * 100}%`;
        particle.style.top = `${Math.random() * 100}%`;

        // Random animation duration between 10s and 20s
        const duration = Math.random() * 10 + 10;
        particle.style.animationDuration = `${duration}s`;

        // Random delay
        particle.style.animationDelay = `${Math.random() * 5}s`;

        particlesContainer.appendChild(particle);
    }
}

// Theme toggle functionality
const themeToggle = document.getElementById("themeToggle");
const themeIcon = document.getElementById("themeIcon");
const html = document.documentElement;

// Check for saved theme or use preferred color scheme
const currentTheme =
    localStorage.getItem("theme") ||
    (window.matchMedia("(prefers-color-scheme: dark)").matches
        ? "dark"
        : "light");

// Apply the current theme
if (currentTheme === "dark") {
    html.setAttribute("data-bs-theme", "dark");
    themeIcon.classList.add("bi-moon");
} else {
    html.setAttribute("data-bs-theme", "light");
    themeIcon.classList.add("bi-sun");
}

// Toggle theme
themeToggle.addEventListener("click", function () {
    if (html.getAttribute("data-bs-theme") === "dark") {
        html.setAttribute("data-bs-theme", "light");
        themeIcon.classList.replace("bi-moon", "bi-sun");
        localStorage.setItem("theme", "light");
    } else {
        html.setAttribute("data-bs-theme", "dark");
        themeIcon.classList.replace("bi-sun", "bi-moon");
        localStorage.setItem("theme", "dark");
    }
});

window.addEventListener("load", createParticles);

window.addEventListener("resize", function () {
    document.getElementById("particles").innerHTML = "";
    createParticles();
});
