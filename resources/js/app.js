import "./bootstrap";
import "preline";
// import Alpine from "alpinejs";

// window.Alpine = Alpine;

// Alpine.start();

// This code should be added to <head>.
// It's used to prevent page load glitches.
if (
    localStorage.getItem("hs_theme") === "dark" ||
    (!localStorage.getItem("hs_theme") &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
    document.documentElement.classList.add("dark");
} else {
    document.documentElement.classList.remove("dark");
}
