// app.js

// Smooth scroll for navbar links
document.querySelectorAll('a.nav-link[href^="#"]').forEach(a => {
  a.addEventListener("click", (e) => {
    const target = document.querySelector(a.getAttribute("href"));
    if (!target) return;
    e.preventDefault();
    target.scrollIntoView({ behavior: "smooth", block: "start" });
  });
});

// Simple AR/EN toggle (UI only)
const btn = document.getElementById("langToggle");
btn?.addEventListener("click", () => {
  const html = document.documentElement;
  const isAr = html.getAttribute("lang") === "ar";
  if (isAr) {
    html.setAttribute("lang", "en");
    html.setAttribute("dir", "ltr");
    btn.textContent = "EN/AR";
  } else {
    html.setAttribute("lang", "ar");
    html.setAttribute("dir", "rtl");
    btn.textContent = "AR/EN";
  }
});