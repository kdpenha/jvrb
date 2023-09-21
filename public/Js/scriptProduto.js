const imgContainer = document.querySelector(".showcase > div");
const img = document.querySelector(".showcase imgProduto");
const shadow = document.querySelector(".shadow");

const thumb = document.querySelectorAll("imgProduto thumbs ");
const titleOverlay = document.querySelector(".titleOverlay");
const title = document.querySelector(".titleText");
const desc = document.querySelector(".description");

const sizes = document.querySelectorAll(".sizes > li");
const stars = document.querySelectorAll(".stars span");
const price = document.querySelector(".price");
const colorBtn = document.querySelectorAll(".color");

const pag = document.querySelectorAll(".pag");
const prev = document.querySelector(".arr-right");
const next = document.querySelector(".arr-left");
const shoeNum = document.querySelector(".shoe-num");
const shoeTotal = document.querySelector(".shoe-total");

let id = 1;
let colorType = 1;
let shoe = 1;

const colors = [
    [
        "#ae001b",
        "#111111"
    ],
    [
        "linear-gradient(0deg, orange, red)",
        "#bda08e"
    ],
    [
        "linear-gradient(0deg, #00b8ea 0%, #e6882d 50%, #e56da6 100%)",
        "linear-gradient(0deg, #dae766, #b2afaa)"
    ],
];

const prices = ["150", "250", "175"];

const names = [
    [
        "Red Nike Jordan Max Aura 3",
        "Black Nike Jordan Max Aura 3"
    ],
    [
        "Black/Orange Nike Air Max 95",
        "Beige/Gray Nike Air Max 95"
    ],
    [
        "Colorful NIKE Jordan Delta 2 SP",
        "Gray NIKE Jordan Delta 2 SP"
    ],
];

const descriptions =[

[
"Bring a piece of history to the city urban streets as you walk into the nike jordan max aura 3 mens sneakers",


],

[ 
    "Bring a piece of history to the city urban streets as you walk into the nike jordan max aura 3 mens sneakers",


],

[
    "Bring a piece of history to the city urban streets as you walk into the nike jordan max aura 3 mens sneakers",
],

];

const ratings = [4, 5, 3];

function getImage (imgType, shoe, colorType, id, extension){
return "img" +
imgType + "/shoe" + shoe + "-" +
colorType + "img/" + id + "." + extension;

}

function resetActive (element, elementClass, i) {
    for (let i = 0; i < element.length; i++) {
        element[i].classList.remove(elementClass + "-active");
    
    }
    element[i].classList.add(elementClass + "-active");

}

function animate (element, time, anim) {
    element.style.animation = anim;

    setTimeout(() => {
        element.style.animation = "none";
    }, time);
    }

    function assignColors(i, shoe) {
        colorBtn[i].style.background = colors[shoe - 1][i];

    }

    function resetStars(shoe) {
        for (let i = 0; i < stars.length; i++) {
            stars[i].innerText = "star_outline";

        }
    

    for (let i = 0; i < ratings[shoe]; i++ ){
        stars[i].innerText = "star";
    
    }
}

for  (let i = 0; i < sizes.length; i++) {
    sizes[i].addEventListener("click", (e) =>{
        resetActive(sizes, "size", i);

    });
}

shoeTotal.innerText = "0" + pag.length;
shoeNum.innerText = "0" + shoe;
price.innerText = "R$" + prices[0];
resetStars(shoe - 1);
title.innerText = names[0][0];
desc.innerText = descriptions[0];

for (let i = 0; i < thumb.length; i++) {
    thumb[i].addEventListener("click", (e) => {
        
        id = i + 1;

        img.src = getImage(
            "showcase", shoe, colorType, id, "png"
            );
        resetActive(thumb, "thumb, i");

        animate(imgContainer, 550, "fade 500ms ease-in-out");

    });
}

for (let i = 0; i < colorBtn.length; i++){
    assignColors(i, shoe);

    colorBtn[i]. addEventListener("click",() => {
    colorType = i + 1;

    setTimeout(() => {
        img.src = getImage(
            "showcase", shoe, colorType, id, "png"
        );
    }, 450);

    for (let i = 0; i < thumb.length; i++){
        thumb[i].src = getImage(
            "thumbs", shoe , colorType, i + 1, "jpg"
        );
    } 

    resetActive(colorBtn, "color", i);

    title.innerText = names[shoe - 1][i];

    animate(img, 550, "jump 500ms ease-in-out");
    animate(shadow, 550, "shadow 500ms ease-in-out");
    animate(titleOverlay, 850, "title 800ms ease");
      
  });
}

function slider(shoe){
    setTimeout(() => {
img.src = getImage(
    "showcase", shoe,colorType,id, "png"
);}, 600);

for (let i = 0; i < thumb.length; i++){
    thumb[i].src = getImage(
        "thumbs", shoe , colorType, i + 1, "jpg"
    );
}

for(let i = 0; i < colorBtn.length; i++){
    assignColors(i, shoe);
}

resetActive(pag, "pag", shoe - 1);

desc.innerText = descriptions[shoe - 1];
title.innerText = names[shoe - 1][colorType - 1];
price.innerText = "$" + prices [shoe - 1];
resetStars(shoe - 1);
shoeNum.innerText = "0" + shoe;


animate(img, 1550, "replace 1.5s ease-in");
animate(shadow, 1550, "shadow2 1.5s eae-in");
animate(titleOverlay, 850, "title 800ms ease");
}

prev.addEventListener("click", () => {
 
    shoe--;

    if (shoe < 1){
        shoe = pag.length;
    }
slider(shoe);
});


next.addEventListener("click", () => {
 
    shoe++;

    if (shoe > pag.length){
        shoe = 1;
    }
slider(shoe);
});

for (let i = 0; i < pag.length; i++){
    pag[i].addEventListener("click",() => {

slider(i + 1);
shoe = i + 1;    
    });
}

    
