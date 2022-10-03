
let player = new Player({x: canvas.width / 2, y: canvas.height / 2})


function update(){
    context.clearRect(0,0,canvas.width, canvas.height)

    player.update()
}

setInterval(update, 8)


window.addEventListener('keydown', (e) => {
    if (e.key == 'd') {
        player.walkRight()
    } else if (e.key == 'a') {
        player.walkLeft()
    }else if (e.key == 'w') {
        player.up()
    }else if (e.key == 's') {
        player.down()
    }
})