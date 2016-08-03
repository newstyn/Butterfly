<!DOCTYPE html>
<html lang="en">
    <head>
    
        <script src="assets/js/robot.js" ></script>
        <script src="assets/js/maze.js" ></script>
        <script src="assets/js/mazespace.js" ></script>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script type="text/javascript" src="assets/js/robotmazeinterface.js" ></script>


        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css" >
        <link rel="stylesheet" type="text/css" href="assets/css/robotmazeinterface.css" >



        <script>
            m = new Maze(7,5);
            m.setStart(1,1,"north");
            m.setEnd(7,1);
            m.setWall(1,1,"east");
            m.setWall(1,3,"north");
            m.setWall(2,1,"north");
            m.setWall(2,2,"north");
            m.setWall(2,4,"north");
            m.setWall(2,3,"east");
            m.setWall(3,2,"north");
            m.setWall(3,4,"north");
            m.setWall(3,1,"east");
            m.setWall(3,2,"east");
            m.setWall(3,1,"east");
            m.setWall(3,4,"east");
            m.setWall(4,2,"north");
            m.setWall(4,3,"north");
            m.setWall(4,3,"east");
            m.setWall(4,5,"east");
            m.setWall(5,1,"north");
            m.setWall(5,2,"east");
            m.setWall(5,4,"east");
            m.setWall(6,1,"east");
            m.setWall(6,2,"north");
            m.setWall(6,3,"east");
            m.setWall(6,4,"north");
            m.setWall(7,3,"north");
            m.setWall(7,4,"north");

            r = new Robot();


            var i = new RobotMazeInterface(r,m,"#page");       
            $(document).ready(function() {
                i.render();
            });
        </script>
    </head>

    <body>
        
            <textarea id="code" rows="10" cols="100">
                /*Type you code here*/
            </textarea>
            <button type="button" onclick="runCode()">run</button>

        <p id="output">Output will be shown here</p>

    </body>

    <script>
        function assignmentFunc(var statement)
        {
            document.getElementById('output').innerHTML = statement;
        }

        function runCode()
        {
            var str = document.getElementById("code").value;
            var arr = str.split(";");

            // for(int i = 0; i <= arr.lenght; i++)
            // {
            //    var statement = arr[i].toString();
            //    if(statement.search('is') >= 0)
            //    {
            //         assignmentFunc(statement);
            //    }
            // }
            var statement = arr[0].toString();
            if(statement.search('is') >= 0)
            {
                    assignmentFunc(statement);
            }
        }
</script>

</html>