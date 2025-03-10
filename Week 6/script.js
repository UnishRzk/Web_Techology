function changeBackground() {
    const red = document.getElementById('red').checked ? 255 : 0;
    const green = document.getElementById('green').checked ? 255 : 0;
    const blue = document.getElementById('blue').checked ? 255 : 0;
    
    if (red === 0 && green === 0 && blue === 0) {
        document.body.style.backgroundColor = 'white'; 
    } else {
        document.body.style.backgroundColor = `rgb(${red}, ${green}, ${blue})`;
    }
}
