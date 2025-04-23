// // js/effect-hover-press.js

// document.addEventListener('DOMContentLoaded', function() {
//     function addDirectionalHoverEffect(selector) {
//         document.querySelectorAll(selector).forEach(item => {
//             item.addEventListener('mouseenter', handleMouseEnter);
//         });
//     }
    
//     function handleMouseEnter(e) {
//         const { left, top, width, height } = this.getBoundingClientRect();
//         const x = e.clientX - left;
//         const y = e.clientY - top;
        
//         const directions = ['hover-from-left', 'hover-from-right', 'hover-from-top', 'hover-from-bottom'];
//         directions.forEach(dir => this.classList.remove(dir));
        
//         if (x < width/3) {
//             this.classList.add('hover-from-left');
//         } else if (x > width*2/3) {
//             this.classList.add('hover-from-right');
//         } else if (y < height/2) {
//             this.classList.add('hover-from-top');
//         } else {
//             this.classList.add('hover-from-bottom');
//         }
//     }
//     addDirectionalHoverEffect('.presse-item');
// });