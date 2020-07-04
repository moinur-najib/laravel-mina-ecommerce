var canvas = document.querySelector("canvas");
var c = canvas.getContext("2d");

canvas.width = innerWidth;
canvas.height = innerHeight;

// Variables
var mouse = {
    x: innerWidth / 2,
    y: innerHeight / 2,
};
var colors = [
    "#2185C5",
    "#FF0000",
    "#00FF00",
    "#0000FF",
    "#FF0000",
    "#9400D3",
    "#4B0082",
    "#0000FF",
    "#00FF00",
    "#FFFF00",
    "#FF7F00",
];

var rColors = [
    "#FF0000",
    "#9400D3",
    "#4B0082",
    "#0000FF",
    "#00FF00",
    "#FFFF00",
    "#FF7F00",
];

// Event Listeners
addEventListener("mousemove", function (event) {
    mouse.x = event.clientX;
    mouse.y = event.clientY;
});

addEventListener("resize", function () {
    canvas.width = innerWidth;
    canvas.height = innerHeight;

    init();
});

// Utility Functions
function randomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}

function randomCol(colors) {
    return colors[Math.floor(Math.random() * colors.length)];

    // for (i = 1; i < colors.length; i++) {
    //   return colors[i];
    // }
}

function rainbow(colors) {
    var rColors = [];
    for (i = 0; i < colors.length; i++) {
        rColors = colors[i];
    }
    return rColors;
}

// Objects
function Particle(x, y, radius, color) {
    this.x = x;
    this.y = y;
    this.radius = radius;
    this.color = color;
    this.radians = Math.random() * Math.PI * 2;
    this.velocity = 0.06;
    this.distanceFromMouse = randomInt(0, 2);
    this.distanceFromPartisclesX = 5;
    this.distanceFromPartisclesY = 0;
    this.lastMouse = {
        x: x,
        y: y,
    };
    this.update = () => {
        const lastPoint = {
            x: this.x,
            y: this.y,
        };

        // Drag Effect
        this.lastMouse.x += (mouse.x - this.lastMouse.x) * 0.05;
        this.lastMouse.y += (mouse.y - this.lastMouse.y) * 0.05;

        this.x = mouse.x + this.distanceFromPartisclesX * this.distanceFromMouse;
        this.y = mouse.y + this.distanceFromPartisclesY * this.distanceFromMouse;

        this.radians += this.velocity;
        // this.x = mouse.x + Math.cos(this.radians) * this.distanceFromCenter;
        // this.y = mouse.y + Math.sin(this.radians) * this.distanceFromCenter;
        this.draw(lastPoint);
    };

    this.draw = function (lastPoint) {
        c.beginPath();
        c.strokeStyle = this.color;
        c.lineWidth = this.radius;
        c.moveTo(lastPoint.x, lastPoint.y);
        c.lineTo(this.x, this.y);
        c.stroke();
        c.closePath();
    };
}

let particles;

function init() {
    particles = [];

    const radius = Math.random() * 2 + 1;

    for (let i = 0; i < 20; i++) {
        const randomColors = randomCol(rColors);
        console.log(randomCol(rColors));
        // const rainbowColors = rainbow(colors);
        particles.push(new Particle(0, 0, 5, randomColors));
    }
}

// Animation Loop
function animate() {
    requestAnimationFrame(animate);
    c.beginPath();
    // c.fillStyle = "rgba(0, 0, 0, 0.05";
    // c.fillRect(0, 0, canvas.width, canvas.height);

    particles.forEach((particle) => {
        particle.update();
    });
}

init();
animate();
