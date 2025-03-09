let count = 0;

function increaseCount() {
    count++;
    document.getElementById("count").textContent = count;
}

function decreaseCount() {
    count--;
    document.getElementById("count").textContent = count;
}
