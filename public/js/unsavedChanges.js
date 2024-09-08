var unsavedChanges = false;
function handleUnsavedChanges(event) {
	event.returnValue = "Twój wpis nie został opublikowany.\nCzy na pewno chcesz opuścić stronę?";
}
function enableUnsavedChanges() {
	window.addEventListener("beforeunload", handleUnsavedChanges);
	unsavedChanges = true;
}
function disableUnsavedChanges() {
	window.removeEventListener("beforeunload", handleUnsavedChanges);
	unsavedChanges = false;
}