function updateOpeningText() {
    let now = new Date();
    let day = now.getDay();
    let hours = now.getHours();

    if (day >= 0 && day <= 4 && hours >= 10 || hours < 2) {
        showOpeningText("Ouvert", "open");
        document.getElementById("day1").style.fontWeight = "bold";
    }
    
    else if ((day == 5 || day == 6) && hours >= 10 || hours < 6) {
        showOpeningText("Ouvert", "open");
        document.getElementById("day2").style.fontWeight = "bold";
    } 
    
    else {
        showOpeningText("Fermé", "closed");
    }
}

function showOpeningText(text, className) {
    let openClosed = document.getElementById("open-closed");
    openClosed.innerHTML = text;
    openClosed.classList.add(className);
}

window.addEventListener('load', updateOpeningText());