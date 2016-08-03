"use strict";

function Robot() {
    this.x = null;
    this.y = null;
    this.orientation = null;
    this.maze = null;
}

//place the robot in the maze
Robot.prototype.setMaze = function(maze) {
    this.maze = maze;

    this.x = maze.startX; //location of the robot in the maze
    this.y = maze.startY; //location of the robot in the maze
    this.orientation = maze.startOrientation; //face of the robot in the maze

    // this.x = 1; //location of the robot in the maze
    // this.y = 1; //location of the robot in the maze
    // this.orientation = "north"; //face of the robot in the maze



    //Due this method a button will created named as "place in maze" in main file.Clicking on the button
    //will put the robot in the place given above as values
};

Robot.prototype.turnRight = function() {
    //validation if robot is in the maze
    //if (!this.maze || !this.maze.isValidDirection(this.orientation)) {

    if (!this.maze || !this.maze.isValidDirection(this.orientation)) {
        return false;
    }

    var rights = {
        north: "east",
        east: "south",
        south: "west",
        west: "north"
    }

    this.orientation = rights[this.orientation];
    i.render();
    return true;
}

Robot.prototype.turnLeft = function() {
    if (!this.maze || !this.maze.isValidDirection(this.orientation)) {
        return false;
    }

    var lefts = {
        north: "west",
        east: "north",
        south: "east",
        west: "south"
    }
    this.orientation = lefts[this.orientation];
    i.render();
    return true;
}

Robot.prototype.moveForward = function() {

    if (!this.canMoveForward()) {
        return false;
    }

    switch (this.orientation) {
        case "north":
            this.y += 1;
            break;
        case "east":
            this.x += 1;
            break;
        case "south":
            this.y -= 1;
            break;
        case "west":
            this.x -= 1;
            break;
    }
    i.render();
    return true;
}

Robot.prototype.canMoveForward = function() {
    if (!this.maze) {
        return false;
    }
    return this.maze.canMove(this.x, this.y, this.orientation);
}

Robot.prototype.exitMaze = function(steps) {
    if (this.maze) {
        while(steps != 0) {
            steps -= 1;
            if (this.canMoveForward()) {
                this.moveForward();
                this.turnLeft();
            } else {
                this.turnRight();
            }
            if (this.x == this.maze.endX && this.y == this.maze.endY) {
                return true;
            }
        }
        return false;
    }
}