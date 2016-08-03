"use strict";

function Maze(width,height) {
  //m = new maze();
    this.width = width;
    this.height = height;

    //the x and y coordinate of the start of the maze
    this.startX           = null;
    this.startY           = null;

    //the direction the robot should be facing when he starts
    this.startOrientation = null;

    //the x and y coordinate of the start of the maze
    this.endX             = null;
    this.endY             = null;

    this.directions = ["north","east","south","west"];
    this.spaces = [];

    var x, y;
    for (x=1; x <= width; x += 1) { //goes through each column and creates an array for it
        this.spaces[x] = [];        //that array element will be another empty array
        for (y=1; y <= height; y += 1) {
            this.spaces[x][y] = new MazeSpace(this.directions); //Each will have a mazespace object
        }
    }
}

//getter setter method MAZE STARTING POINT
Maze.prototype.setStart = function(x, y, orientation) {

    //Validation by custom methods
    if (this.isInBounds(x, y) && this.isValidDirection(orientation)) {
        this.startX = x;
        this.startY = y;
        this.startOrientation = orientation;
        return true;
    }
    return false;
}

//getter setter method MAZE ENDING POINT
Maze.prototype.setEnd = function (x, y) {
    if (!this.isInBounds(x, y)) {
        return false;
    }
    this.endX = x;
    this.endY = y;
    return true;
}

Maze.prototype.setWall = function (x, y, direction) {
    if (this.isInBounds(x, y) && this.isValidDirection(direction)) {
        this.spaces[x][y].setWall(direction);
        return true;
    }
    return false;
}

Maze.prototype.isValidDirection = function(direction) {
    return this.directions.indexOf(direction) !== -1;    
}

Maze.prototype.isInBounds = function (x, y) {
    return x > 0 && x <= this.width && y > 0 && y <= this.height;
}

Maze.prototype.canMove = function (x, y, direction) {
    if (!this.isValidDirection(direction)) {
        return false;
    }

    if (!this.isInBounds(x,y)) {
        return false;
    }

    var forwardX, forwardY;
    switch (direction) {
      case "north":
          forwardX = x;
          forwardY = y+1;
          break;
      case "east":
          forwardX = x+1;
          forwardY = y;
          break;
      case "south":
          forwardX = x;
          forwardY = y-1;
          break;
      case "west":
          forwardX = x-1;
          forwardY = y;
          break;
    }
    if (!this.isInBounds(forwardX,forwardY)) {
        return false;
    }

    if (this.spaces[x][y][direction]) {
        return false;
    }

    var opposites = {
        north: "south",
        east: "west",
        south: "north",
        west: "east"
    };
    if (this.spaces[forwardX][forwardY][opposites[direction]]) {
        return false;
    }



    return true;
}