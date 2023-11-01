// cancel button search
const input = document.querySelector(".clear-input")
const clearButton = document.querySelector(".clear-input-button")

const handleInputChange = (e) => {
if (e.target.value && !input.classList.contains("clear-input--touched")) {
input.classList.add("clear-input--touched")
} else if (!e.target.value && input.classList.contains("clear-input--touched")) {
input.classList.remove("clear-input--touched")
}
}

const handleButtonClick = (e) => {
input.value = ''
input.focus()
input.classList.remove("clear-input--touched")
}

clearButton.addEventListener("click", handleButtonClick)
input.addEventListener("input", handleInputChange)

