class Player {
    constructor({x, y}){
        this.x = x
        this.y = y
        this.playerImageWalk1 = new Image()
        this.playerImageWalk1.src = './source/image/playerGrey_walk1.png'
    }

    walkRight(){
        this.x += 10
    }
    
    walkLeft(){
        this.x -= 10
    }
    
    up(){
        this.y -= 10
    }
    down(){
        this.y += 10
    }

    draw(){
        context.drawImage(this.playerImageWalk1, this.x - 50, this.y - 50, 50, 50)
    }

    update(){
        this.draw()

     
    }

}