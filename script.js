
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".service-desc").forEach(desc => {
        desc.style.display = "none";
    });

    document.querySelectorAll(".service-btn").forEach(button => {
        button.addEventListener("click", () => {
            const target = document.getElementById(button.dataset.target);
            target.style.display = target.style.display === "block" ? "none" : "block";
        });
    });
});
