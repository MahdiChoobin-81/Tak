
const colors = document.querySelectorAll('.color');

function changeColor(){
    colors.forEach(c => c.classList.remove('active'));

    this.classList.add('active');

    document.cookie = "colorId = " + this.id;
}

colors.forEach(c => c.addEventListener('click', changeColor));



