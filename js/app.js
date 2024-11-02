gsap.registerPlugin(ScrollTrigger, ScrollSmoother)

var navbar = document.getElementById("nav-bar");


var navbar__colored = navbar.offsetHeight*8;

function navbarChange() {
    if (window.scrollY >= navbar__colored) {
        navbar.classList.add("nav-bar__colored")
    } else {
        navbar.classList.remove("nav-bar__colored");
    }
}

function elementsAppearence()
{
    gsap.fromTo('.main-section',{ opacity:1 },{
        opacity: 0,
        scrollTrigger:{
            trigger: '.main-section',
            start: 'center',
            end:'bottom',
            scrub: true
        }})

    let itemsL = gsap.utils.toArray('.info__left .info__item')

    itemsL.forEach(item => {
        gsap.fromTo(item,{x:-50, opacity: 0},{
            opacity:1,
            x:0,
            scrollTrigger: {
                trigger: item,
                start:'-800',
                end:'-100',
                scrub:true
            }
        })
    })

    let itemsR = gsap.utils.toArray('.info__right .info__item')

    itemsR.forEach(item => {
        gsap.fromTo(item,{x:50, opacity: 0},{
            opacity:1,
            x:0,
            scrollTrigger: {
                trigger: item,
                start:'-800',
                end:'-100',
                scrub:true
            }
        })
    })
}

window.onscroll = function() {navbarChange()};
elementsAppearence();


if(ScrollTrigger.isTouch !== 1){
    ScrollSmoother.create({
        wrapper: '.wrapper',
        content: '.content',
        smooth: 1.5,
        effects: true
    })
}
