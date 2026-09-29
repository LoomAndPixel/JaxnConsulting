// Phone menu: the round button opens the full-screen menu; the close button, Escape or a link closes it.
// Opening adds is-menu-open / has-modal-open, which site.css and blocks.css style.
document.querySelectorAll(".block-navigation").forEach(function (nav) {
	var openBtn = nav.querySelector(".block-navigation__responsive-container-open");
	var panel = nav.querySelector(".block-navigation__responsive-container");
	var closeBtn = nav.querySelector(".block-navigation__responsive-container-close");
	var dialog = nav.querySelector(".block-navigation__responsive-dialog");
	if (!openBtn || !panel) return;

	function setOpen(open) {
		panel.classList.toggle("is-menu-open", open);
		panel.classList.toggle("has-modal-open", open);
		document.documentElement.classList.toggle("has-modal-open", open);
		if (dialog) {
			if (open) {
				dialog.setAttribute("role", "dialog");
				dialog.setAttribute("aria-modal", "true");
				dialog.setAttribute("aria-label", "Menu");
			} else {
				dialog.removeAttribute("role");
				dialog.removeAttribute("aria-modal");
				dialog.removeAttribute("aria-label");
			}
		}
		(open ? closeBtn : openBtn).focus();
	}

	openBtn.addEventListener("click", function () { setOpen(true); });
	if (closeBtn) closeBtn.addEventListener("click", function () { setOpen(false); });
	panel.addEventListener("keydown", function (e) {
		if (e.key === "Escape" && panel.classList.contains("is-menu-open")) setOpen(false);
	});
	panel.querySelectorAll("a").forEach(function (a) {
		a.addEventListener("click", function () { if (panel.classList.contains("is-menu-open")) setOpen(false); });
	});
});
