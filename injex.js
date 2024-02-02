var tl = gsap.timeline()



tl.from("#nav1", {
    y: -80,
    duration: 0.5,
    delay: 0.5,
    opacity: 0,
    stagger: 0.3,
})
tl.from("#main-txt", {
    x: -200,
    duration: 0.5,
    opacity: 0,
    stagger: 0.3,
})
tl.from("#first-jakacet", {

    duration: 0.8,
    opacity: 0,
    scale: 2,

})

gsap.from("#hello", {
    y: -200,
    duration: 0.5,
    opacity: 0,
    scale: 0,
    scrollTrigger: {
        trigger: "#hello",
        scroller: "body",
        // markers: true,
        scrub: 3,
        start:"top 550px",
        end:"top 450px",
    }
})

gsap.from("#hello1", {
    y: -200,
    duration: 0.5,
    opacity: 0,
    scale: 0,
    scrollTrigger: {
        trigger: "#hello1",
        scroller: "body",
        // markers: true,
        scrub: 3,
        start:"top 550px",
        end:"top 450px",
    }
})
gsap.from("#hello2", {

    y: -200,
    duration: 0.5,
    opacity: 0,
    scale: 0,
    scrollTrigger: {
        trigger: "#hello2",
        scroller: "body",
        // markers: true,
        scrub: 3,
        start:"top 550px",
        end:"top 450px",
    }

})

gsap.from("#hello3", {

    y: -200,
    duration: 0.5,
    opacity: 0,
    scale: 0,
    scrollTrigger: {
        trigger: "#hello3",
        scroller: "body",
        // markers: true,
        scrub: 3,
        start:"top 550px",
        end:"top 450px",
    }

})

