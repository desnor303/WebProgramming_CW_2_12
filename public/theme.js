(function () {
    const STORAGE_KEY = "greenwick-theme";
    const root = document.documentElement;
    const toggleBtn = document.getElementById("theme-toggle");

    function applyTheme(theme) {
        root.setAttribute("data-theme", theme);

        if (toggleBtn) {
            toggleBtn.textContent = theme === "dark" ? "☀️ Light" : "🌙 Dark";
        }
    }

    // 1. Lấy theme đã lưu
    const saved = localStorage.getItem(STORAGE_KEY);
    if (saved === "dark" || saved === "light") {
        applyTheme(saved);
    } else {
        // 2. Nếu chưa lưu, theo hệ thống
        const prefersDark =
            window.matchMedia &&
            window.matchMedia("(prefers-color-scheme: dark)").matches;
        applyTheme(prefersDark ? "dark" : "light");
    }

    // 3. Bắt sự kiện click
    if (toggleBtn) {
        toggleBtn.addEventListener("click", function () {
            const current =
                root.getAttribute("data-theme") === "dark" ? "dark" : "light";
            const next = current === "dark" ? "light" : "dark";
            applyTheme(next);
            localStorage.setItem(STORAGE_KEY, next);
        });
    }
})();
