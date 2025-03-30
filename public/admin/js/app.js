// Mobile sidebar toggle
document
    .getElementById("mobileToggleBtn")
    .addEventListener("click", function () {
        document.getElementById("sidebar").classList.toggle("show");
    });

document
    .getElementById("mobileCloseBtn")
    .addEventListener("click", function () {
        document.getElementById("sidebar").classList.remove("show");
    });

// Theme Toggle
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
    themeIcon.classList.add("bi-sun");
} else {
    html.setAttribute("data-bs-theme", "light");
    themeIcon.classList.add("bi-moon");
}

// Toggle theme
themeToggle.addEventListener("click", function () {
    if (html.getAttribute("data-bs-theme") === "dark") {
        html.setAttribute("data-bs-theme", "light");
        themeIcon.classList.replace("bi-sun", "bi-moon");
        localStorage.setItem("theme", "light");
    } else {
        html.setAttribute("data-bs-theme", "dark");
        themeIcon.classList.replace("bi-moon", "bi-sun");
        localStorage.setItem("theme", "dark");
    }
});

// Custom dropdown toggle function
function toggleDropdown(id) {
    const dropdown = document.getElementById(id);
    dropdown.classList.toggle("show");

    // Close other dropdowns
    document.querySelectorAll(".header-dropdown-menu").forEach((menu) => {
        if (menu.id !== id && menu.classList.contains("show")) {
            menu.classList.remove("show");
        }
    });
}

// Close dropdowns when clicking outside
document.addEventListener("click", function (e) {
    if (!e.target.closest(".header-dropdown")) {
        document
            .querySelectorAll(".header-dropdown-menu.show")
            .forEach((menu) => {
                menu.classList.remove("show");
            });
    }
});

// Charts
// Sales Chart (Line)
const salesCtx = document.getElementById("salesChart").getContext("2d");
const salesChart = new Chart(salesCtx, {
    type: "line",
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
        datasets: [
            {
                label: "Sales",
                data: [12000, 19000, 15000, 18000, 22000, 25000],
                borderColor: "#6c5ce7",
                backgroundColor: "rgba(108, 92, 231, 0.1)",
                tension: 0.4,
                fill: true,
            },
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
            },
        },
    },
});

// Revenue Chart (Doughnut)
const revenueCtx = document.getElementById("revenueChart").getContext("2d");
const revenueChart = new Chart(revenueCtx, {
    type: "doughnut",
    data: {
        labels: ["Electronics", "Fashion", "Home", "Other"],
        datasets: [
            {
                data: [45, 25, 20, 10],
                backgroundColor: ["#6c5ce7", "#00b894", "#fdcb6e", "#d63031"],
                borderWidth: 0,
            },
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: "right",
            },
        },
    },
});
