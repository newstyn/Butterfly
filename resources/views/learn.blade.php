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
            //creating a new maze object
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

            // create robot and pass it to the RobotMazeInterfaceObject
            r = new Robot();

            //The main program can access it by using the javascript file and then creating this RobotMazeInterFace object
            // can use the i.render method to create new maze.

            var i = new RobotMazeInterface(r,m,"#page");       
        
            $(document).ready(function() {
                i.render();

                document.getElementById("inputCode").innerHTML="";
                document.getElementById("outputCode").innerHTML="";

            });       

                
            /**********************************************************************************************************/
            //x is 1;y is 1;z is x plus y;keep doing show x,show y,show z, for 2 times;
            //if 1 equals 1 do show x,;
                
            // (function () {
            //                 document.getElementById("inputCode").innerHTML="";
            //                 document.getElementById("outputCode").innerHTML="";
            // })();

            totalVars = 0;
            totalVals = 0;
                
            allVars = [];
            allVals = [];

            wrongMove = 0;
            rightMove = 0;

            function reset()
            {
                document.getElementById("outputCode").innerHTML="";
                //This variable keeps record of how many variables have been made in the program
                //It acts as a counter variable for allVars array
                totalVars = 0;
                //This variable keeps record of how many variables have been made in the program
                //It acts as a counter variable for allVars array
                totalVals = 0;

                //All VariableNames of the this program are stored in allVars array
                allVars = [];
                //All values of all varibales are stored in allVals array
                allVals = [];
            }                

            function assignmentFunc(statement)
                {
                    //x is 1;
                    //x is from user;
                    //z is x plus y;
                    
                   var tempArr = statement.split(" ");
                   
                   //x is from user;
                   if(tempArr[2] == "from" )
                    {
                        allVars[totalVars] = tempArr[0];

                        var tempVal = prompt("Enter the value");
                        allVals[totalVals] = tempVal;
                    }

                    //z is x plus y;
                    else if(tempArr.length > 4)
                    {
                        var arr = [];
                        var statement = "";

                        if(tempArr[3] == 'plus')
                        {
                            
                            //making valid statement for plus function
                            arr[0] = tempArr[2];
                            arr[1] = tempArr[3];
                            arr[2] = tempArr[4];

                            statement = arr.join(" ");
                            console.log("The statement is "+statement);
                            var tempVar = addFunc(statement);
                            console.log("The result is "+tempVar);

                            //Storing the result returned by the plus function in global allVars array
                            allVars[totalVars] = tempArr[0];
                            allVals[totalVals] = tempVar;
                        }

                        if(tempArr[3] == 'minus')
                        {
                            arr[0] = tempArr[2];
                            arr[1] = tempArr[3];
                            arr[2] = tempArr[4];

                            statement = arr.join(" ");
                            
                            var tempVar = minusFunc(statement);

                            allVars[totalVars] = tempArr[0];
                            allVals[totalVals] = tempVar;
                        }

                        if(tempArr[3] == 'mul')
                        {
                            arr[0] = tempArr[2];
                            arr[1] = tempArr[3];
                            arr[2] = tempArr[4];

                            statement = arr.join(" ");
                            
                            var tempVar = mulFunc(statement);

                            allVars[totalVars] = tempArr[0];
                            allVals[totalVals] = tempVar;
                        }

                        if(tempArr[3] == 'div')
                        {
                            arr[0] = tempArr[2];
                            arr[1] = tempArr[3];
                            arr[2] = tempArr[4];

                            statement = arr.join(" ");
                            
                            var tempVar = divFunc(statement);

                            allVars[totalVars] = tempArr[0];
                            allVals[totalVals] = tempVar;
                        }
                    }
                    
                    //z is 1
                    else
                    {
                        allVars[totalVars] = tempArr[0];
                        allVals[totalVals] = tempArr[2]; 
                    }

                    //Incrementing the counters for allVars and allVals
                    totalVars += 1;
                    totalVals += 1;
                }

                //show variable
                //show string
                //show variable and string
                function showFunc(statement)
                {
                    //Creating array and array variable for the purpose of storing quotes
                    var quotesArr = [];
                    var quotesVar = 0;

                    
                    //Splitting the array in characters so that it can be easy to find tha index of quotes
                    //Example:show "My name is Hafiz Arslan Amjad";
                    var charArr = statement.split("");

                    
                    //Storing Locations of Quotes
                    for(var i = 0; i < charArr.length; i++)
                    {
                        if(charArr[i] == "\"")
                        {
                            //Storing the index of found quotes in charArr to quotesArr
                            quotesArr[quotesVar] = i;
                            //indication that quotes were found in the statement
                            quotesVar = quotesVar + 1;
                        }
                    }


                    var stringToShowArr = [];
                    var stringToShowVar = 0;

                    //if quotesVar is greater than 0 then it is the indication that there were more than one quotes
                    if(quotesVar > 0)
                    {
                        for(var k = 0; k<quotesArr.length; k+=2)
                        {
                            index1 = quotesArr[k];
                            index1 = index1 + 1;
                            console.log("index1:"+index1);
                            
                            index2 = quotesArr[k+1];
                            index2 = index2;
                            console.log("index2:"+index2);

                            stringToShowArr[stringToShowVar] = statement.substring(index1 , index2);

                            //checking if there is some variables outside the quotes
                            if( charArr.length >= index2+2 )
                            {
                              var variable = charArr[index2+2];
                              stringToShowVar++;
                              
                              var pos = allVars.indexOf(variable);
                              stringToShowArr[stringToShowVar] = parseInt(allVals[pos]);
                              //stringToShowArr[stringToShowVar] = variable;
                            }

                            stringToShowVar++;
                            var result = "";
                            for(var j = 0; j < stringToShowArr.length ; j++)
                            {
                                result = result + stringToShowArr[j];
                            }

                            document.getElementById('outputCode').innerHTML = result;
                        }
                    }

                    //x is 1
                    else
                    {
                        var arr = statement.split(" ");

                        var pos = allVars.indexOf(arr[1]);

                        tempText = document.getElementById('outputCode').innerHTML; 
                        document.getElementById('outputCode').innerHTML = tempText+parseInt(allVals[pos])+"\n";
                    }
                }

                function addFunc(statement)
                {
                    console.log(statement);
                    var arr = statement.split(" ");
                    console.log(arr);
                    var pos1 = allVars.indexOf(arr[0]);
                    var pos2 = allVars.indexOf(arr[2]);

                    pos1 = parseInt(allVals[pos1]);
                    pos2 = parseInt(allVals[pos2]);

                    var result = pos1 + pos2;
                    return result;
                }

                function minusFunc(statement)
                {
                    var arr = statement.split(" ");

                    var pos1 = allVars.indexOf(arr[0]);
                    var pos2 = allVars.indexOf(arr[2]);

                    pos1 = parseInt(allVals[pos1]);
                    pos2 = parseInt(allVals[pos2]);

                    var result = pos1 - pos2;
                    return result;
                }

                function mulFunc(statement)
                {
                    var arr = statement.split(" ");

                    var pos1 = allVars.indexOf(arr[0]);
                    var pos2 = allVars.indexOf(arr[2]);

                    pos1 = parseInt(allVals[pos1]);
                    pos2 = parseInt(allVals[pos2]);

                    var result = pos1 * pos2;
                    return result;
                }

                function divFunc(statement)
                {
                    var arr = statement.split(" ");

                    var pos1 = allVars.indexOf(arr[0]);
                    var pos2 = allVars.indexOf(arr[2]);

                    pos1 = parseInt(allVals[pos1]);
                    pos2 = parseInt(allVals[pos2]);

                    var result = pos1 / pos2;
                    return result;
                }

                function ifFunc(statement)
                {
                    //if x equals y
                        //result1 is number and result2 is number
                        //result1 is number and result2 is not a number
                        //result1 is not a number and result2 is a number
                        //result1 and result2 are not numbers

                    //if x greater than y
                    //if x greater than or equals y

                    //if x less than y
                    //if x less than or equals y

                    //if x not equals y

                    //if 1 equals 1 perform show x,;
                    var flag;
                    
                    if(statement.indexOf("equals") == 5 && statement.search("or") < 0)
                    {
                        console.log("am in");
                        var arr = statement.split(" ");
                        
                        //if x greater than y

                        if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[3])) == false )
                        {
                            if( parseInt(arr[1]) == parseInt(arr[3]) )
                            {
                                console.log("1:True");
                                flag = true;
                                console.log(flag);

                                //return true;
                            }
                            else
                            {
                                console.log("1:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[3])) == true )
                        {
                            
                            var pos2 = allVars.indexOf(arr[3]);
                            pos2 = parseInt(allVals[pos2]);

                            if( parseInt(arr[1]) == pos2 )
                            {
                                console.log("2:True");
                                flag = true;
                                return true;  
                            }
                            else
                            {
                                console.log("2:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[3])) == false )
                        {
                            
                            var pos1 = allVars.indexOf(arr[1]);
                            pos1 = parseInt(allVals[pos1]);

                            if( pos1 == parseInt(arr[3]) )
                            {
                                console.log("3:True");
                                flag = true;
                                return true; 
                            }
                            else
                            {
                                console.log("3:False");
                                flag = false;
                                return false;
                            }
                        }

                        //else if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[3])) == true )
                        else
                        {
                            var pos1 = allVars.indexOf(arr[1]);
                            var pos2 = allVars.indexOf(arr[3]);

                            pos1 = parseInt(allVals[pos1]);
                            pos2 = parseInt(allVals[pos2]);

                            if( pos1 == pos2 )
                            {
                                console.log("4:True");
                                flag = true;
                                return true; 
                            }
                            else 
                            {
                                console.log("4:False");
                                flag = false;
                                return false;
                            }
                        }
                    }

                    if(statement.indexOf("greater") == 5 && statement.search("or") < 0)
                    {
                        var arr = statement.split(" ");
                        //if x greater than y

                        if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[4])) == false )
                        {
                            if( parseInt(arr[1]) > parseInt(arr[4]) )
                            {
                                console.log("1:True");
                                flag = true;
                                return true;
                            }
                            else
                            {
                                console.log("1:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[4])) == true )
                        {

                            var pos2 = allVars.indexOf(arr[4]);
                            pos2 = parseInt(allVals[pos2]);

                            if( parseInt(arr[1]) > pos2 )
                            {
                                console.log("2:True");
                                flag = true;
                                return true;  
                            }
                            else
                            {
                                console.log("2:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[4])) == false )
                        {
                            
                            var pos1 = allVars.indexOf(arr[1]);
                            pos1 = parseInt(allVals[pos1]);

                            if( pos1 > parseInt(arr[4]) )
                            {
                                console.log("3:True");
                                flag = true;
                                return true; 
                            }
                            else
                            {
                                console.log("3:False");
                                flag = false;
                                return false;
                            }
                        }

                        //else if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[4])) == true )
                        else
                        {
                            var pos1 = allVars.indexOf(arr[1]);
                            var pos2 = allVars.indexOf(arr[4]);

                            pos1 = parseInt(allVals[pos1]);
                            pos2 = parseInt(allVals[pos2]);

                            if( pos1 > pos2 )
                            {
                                console.log("4:True");
                                flag = true;
                                return true; 
                            }
                            else 
                            {
                                console.log("4:False");
                                flag = false;
                                return false;
                            }
                        }
                    }

                    if(statement.indexOf("less") == 5 && statement.search("or") < 0)
                    {
                        var arr = statement.split(" ");
                        //if x greater than y

                        if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[4])) == false )
                        {
                            if( parseInt(arr[1]) < parseInt(arr[4]) )
                            {
                                console.log("1:True");
                                flag = true;
                                return true;
                            }
                            else
                            {
                                console.log("1:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[4])) == true )
                        {

                            var pos2 = allVars.indexOf(arr[4]);
                            pos2 = parseInt(allVals[pos2]);

                            if( parseInt(arr[1]) < pos2 )
                            {
                                console.log("2:True");
                                flag = true;
                                return true;  
                            }
                            else
                            {
                                console.log("2:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[4])) == false )
                        {
                            
                            var pos1 = allVars.indexOf(arr[1]);
                            pos1 = parseInt(allVals[pos1]);

                            if( pos1 < parseInt(arr[4]) )
                            {
                                console.log("3:True");
                                flag = true;
                                return true; 
                            }
                            else
                            {
                                console.log("3:False");
                                flag = false;
                                return false;
                            }
                        }

                        //if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[4])) == true )
                        else
                        {
                            var pos1 = allVars.indexOf(arr[1]);
                            var pos2 = allVars.indexOf(arr[4]);

                            pos1 = parseInt(allVals[pos1]);
                            pos2 = parseInt(allVals[pos2]);

                            if( pos1 < pos2 )
                            {
                                console.log("4:True");
                                flag = true;
                                return true; 
                            }
                            else 
                            {
                                console.log("4:False");
                                flag = false;
                                return false;
                            }
                        }
                    }

                    if(statement.indexOf("not") == 5 && statement.indexOf("equals") == 9)
                    {
                        var arr = statement.split(" ");
                        //if x not equals than y

                        if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[5])) == false )
                        {
                            if( parseInt(arr[1]) != parseInt(arr[5]) )
                            {
                                console.log("1:True");
                                flag = true;
                                return true;
                            }
                            else
                            {
                                console.log("1:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[5])) == true )
                        {
                            
                            var pos2 = allVars.indexOf(arr[5]);
                            pos2 = parseInt(allVals[pos2]);

                            if( parseInt(arr[1]) != pos2 )
                            {
                                console.log("2:True");
                                flag = true;
                                return true;  
                            }
                            else
                            {
                                console.log("2:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[5])) == false )
                        {
                            
                            var pos1 = allVars.indexOf(arr[1]);
                            pos1 = parseInt(allVals[pos1]);

                            if( pos1 != parseInt(arr[5]) )
                            {
                                console.log("3:True");
                                flag = true;
                                return true; 
                            }
                            else
                            {
                                console.log("3:False");
                                flag = false;
                                return false;
                            }
                        }

                        //if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[5])) == true )
                        else
                        {
                            var pos1 = allVars.indexOf(arr[1]);
                            var pos2 = allVars.indexOf(arr[5]);

                            pos1 = parseInt(allVals[pos1]);
                            pos2 = parseInt(allVals[pos2]);

                            if( pos1 != pos2 )
                            {
                                console.log("4:True");
                                flag = true;
                                return true; 
                            }
                            else 
                            {
                                console.log("4:False");
                                flag = false;
                                return false;
                            }
                        }
                    }

                    if(statement.indexOf("greater") == 5 && statement.indexOf("equals") == 21)
                    {
                        var arr = statement.split(" ");
                        //if x greater than or equals y

                        if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[6])) == false )
                        {
                            if( parseInt(arr[1]) >= parseInt(arr[6]) )
                            {
                                console.log("1:True");
                                flag = true;
                                return true;
                            }
                            else
                            {
                                console.log("1:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[6])) == true )
                        {

                            var pos2 = allVars.indexOf(arr[6]);
                            pos2 = parseInt(allVals[pos2]);

                            if( parseInt(arr[1]) >= pos2 )
                            {
                                console.log("2:True");
                                flag = true;
                                return true;  
                            }
                            else
                            {
                                console.log("2:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[6])) == false )
                        {
                            
                            var pos1 = allVars.indexOf(arr[1]);
                            pos1 = parseInt(allVals[pos1]);

                            if( pos1 >= parseInt(arr[6]) )
                            {
                                console.log("3:True");
                                flag = true;
                                return true; 
                            }
                            else
                            {
                                console.log("3:False");
                                flag = false;
                                return false;
                            }
                        }

                        //if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[6])) == true )
                        else
                        {
                            var pos1 = allVars.indexOf(arr[1]);
                            var pos2 = allVars.indexOf(arr[6]);

                            pos1 = parseInt(allVals[pos1]);
                            pos2 = parseInt(allVals[pos2]);

                            if( pos1 >= pos2 )
                            {
                                console.log("4:True");
                                flag = true;
                                return true; 
                            }
                            else 
                            {
                                console.log("4:False");
                                flag = false;
                                return false;
                            }
                        }
                    }

                    //if x less than y
                    //if x less than or equals y

                    if(statement.indexOf("less") == 5 && statement.indexOf("equals") == 18)
                    {
                        var arr = statement.split(" ");
                        //if x greater than y

                        if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[6])) == false )
                        {
                            if( parseInt(arr[1]) <= parseInt(arr[6]) )
                            {
                                console.log("1:True");
                                flag = true;
                                return true;
                            }
                            else
                            {
                                console.log("1:False");
                                flag = true;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[6])) == true )
                        {

                            var pos2 = allVars.indexOf(arr[6]);
                            pos2 = parseInt(allVals[pos2]);

                            if( parseInt(arr[1]) <= pos2 )
                            {
                                console.log("2:True");
                                flag = true;
                                return true;  
                            }
                            else
                            {
                                console.log("2:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[6])) == false )
                        {
                            
                            var pos1 = allVars.indexOf(arr[1]);
                            pos1 = parseInt(allVals[pos1]);

                            if( pos1 <= parseInt(arr[6]) )
                            {
                                console.log("3:True");
                                flag = true;
                                return true; 
                            }
                            else
                            {
                                console.log("3:False");
                                flag = false;
                                return false;
                            }
                        }

                        //if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[6])) == true )
                        else
                        {
                            var pos1 = allVars.indexOf(arr[1]);
                            var pos2 = allVars.indexOf(arr[6]);

                            pos1 = parseInt(allVals[pos1]);
                            pos2 = parseInt(allVals[pos2]);

                            if( pos1 <= pos2 )
                            {
                                console.log("4:True");
                                flag = true;
                                return true; 
                            }
                            else 
                            {
                                console.log("4:False");
                                flag = false;
                                return false;
                            }
                        }
                    }

                    //if 1 equals 1 do show x,; 
                    console.log(flag);
                    if(flag == true)
                    {
                        var index1 = statement.indexOf("do");
                        index1 = index1 + 3;
                            
                        var index2 = statement.lastIndexOf(",");
                        var work = statement.substring(index1 , index2);
                        console.log(work);

                        work = work.split(",");
                        console.log(work);


                        var forStatement;
                        console.log(work.length);

                        for(var j = 0; j <= work.length-1; j++)
                        {
                            forStatement = work[j];
                            console.log(forStatement);

                            if(forStatement.search("show") >= 0)
                            {
                                
                                showFunc(forStatement);
                            }

                            if(forStatement.search("is") >= 0)
                            {
                                assignmentFunc(forStatement);
                            }

                            else if(forStatement.search("plus") >= 0)
                            {
                                addFunc(forStatement);
                            }

                            else if(forStatement.search("minus") >= 0)
                            {
                                minusFunc(forStatement);
                            }

                            else if(forStatement.search("div") >= 0)
                            {
                                divFunc(forStatement);
                            }

                            if(forStatement.search("mul") >= 0)
                            {
                                mulFunc(forStatement);
                            }

                            if(forStatement.search("if") >= 0)
                            {
                                ifFunc(forStatement);
                            }

                            if(forStatement.search("keep") >= 0)
                            {
                                console.log("loop");
                                doFunc(forStatement);
                            }

                            if(forStatement.search("turn") >= 0)
                            {
                                turnFunc(statement);
                            }

                            if(forStatement.search("move") >= 0)
                            {
                                moveFunc(statement);
                            }
                        }
                    }
                }    

                function doFunc(statement)
                {
                    //keep doing show x for 10 times;
                    var counter;
                    var index1;
                    var index2;

                    index1 = statement.indexOf("doing");
                    index1 = index1 + 6;

                    index2 = statement.indexOf("for");
                    index2 = index2 - 1;

                    work = statement.substring(index1 , index2);

                    index1 = statement.indexOf("for");
                    index1 = index1 + 4;

                    index2 = statement.indexOf("times");
                    index2 = index2 - 1;

                    var counter = statement.substring(index1 , index2);
                    counter = parseInt(counter);

                    work = work.split(",");
                    var forStatement;

                    for(var i = 1; i <= counter; i+=1)
                    {
                        
                        for(var j = 0; j <= work.length-2; j++)
                        {
                            forStatement = work[j];
                            console.log(forStatement);

                            if(forStatement.search("show") >= 0)
                            {
                                
                                showFunc(forStatement);
                            }

                            if(forStatement.search("is") >= 0)
                            {
                                assignmentFunc(forStatement);
                            }

                            else if(forStatement.search("plus") >= 0)
                            {
                                addFunc(forStatement);
                            }

                            else if(forStatement.search("minus") >= 0)
                            {
                                minusFunc(forStatement);
                            }

                            else if(forStatement.search("div") >= 0)
                            {
                                divFunc(forStatement);
                            }

                            if(forStatement.search("mul") >= 0)
                            {
                                mulFunc(forStatement);
                            }

                            if(forStatement.search("if") >= 0)
                            {
                                ifFunc(forStatement);
                            }

                            if(forStatement.search("keep") >= 0)
                            {
                                console.log("loop");
                                doFunc(forStatement);
                            }
                        }
                    }
                }

                function turnFunc(statement)
                {
                    var arr = statement.split(" ");
                    if( arr[1] == 'right')
                    {
                        console.log("turn right");
                        r.turnRight();
                    }

                    if( arr[1] == 'left')
                    {
                        console.log("move left");
                        r.turnLeft();
                    }
                }

                function moveFunc(statement)
                {
                    var result = r.moveForward();
                    
                    if(result == false)
                    {
                        wrongMove += 1;
                        document.getElementById("wrongMoves").value = wrongMove;
                    }

                    else
                    {
                        rightMove += 1;
                        document.getElementById("rightMoves").value = rightMove;
                    }
                }

                function runCode()
                {
                    reset();

                    var str = document.getElementById("inputCode").value;
                    var arr = str.split(";");

                    var statement;

                    for(var i = 0; i <= arr.length-2; i++)
                    {
                       statement = arr[i];

                       if(statement.search("show") >= 0 && statement.search("show") <= 3)
                       {
                            showFunc(statement);
                       }

                       if(statement.search("is") > 1 && statement.search("is") <= 3)
                       {
                            assignmentFunc(statement);
                       }

                       else if(statement.search("plus") > 6 && statement.search("plus") < 11)
                       {
                            addFunc(statement);
                       }

                       else if(statement.search("minus") > 6 && statement.search("minus") < 12)
                       {
                            minusFunc(statement);
                       }

                       else if(statement.search("div") > 6 && statement.search("div") < 10)
                       {
                            divFunc(statement);
                       }

                       if(statement.search("mul") > 6 && statement.search("mul") < 10)
                       {
                            mulFunc(statement);
                       }

                       if(statement.search("if") >= 0 && statement.search("if") < 2)
                       {
                        ifFunc(statement);
                       }

                       if(statement.search("keep") >= 0 && statement.search("keep") < 5)
                       {
                        doFunc(statement);
                       }

                       if(statement.search("turn") >= 0)
                       {
                        turnFunc(statement);
                       }

                       if(statement.search("move") >= 0)
                       {
                        moveFunc(statement);
                       }
                    }
                }
                //keep doing show x, for 2 times
            /**********************************************************************************************************/

        </script>
    </head>

    <body>
        
        <form method="get" action="/updatePoints">
            <label for="wrongmoves">Wrong Moves
                <input type="number" id="wrongMoves" name="wrongmoves" value="0">
            </label>

            <label for="rightmoves">Right Moves
                <input type="number" id="rightMoves" name="rightmoves" value="0">
            </label>

            <input type="submit" name="save">
        </form>

        <div id="page">
            
        </div>

            <textarea id="inputCode" rows="10" cols="100">
            </textarea>
            <br>

            <button type="button" onclick="runCode()">run</button>
            <br>

            <textarea id="outputCode" rows="10" cols="100">
            </textarea>
            

            <!-- <script>
            //x is 1;y is 1;z is x plus y;keep doing show x,show y,show z, for 2 times;
                (function () {
                                document.getElementById("inputCode").innerHTML="";
                                document.getElementById("outputCode").innerHTML="";
                })();

                totalVars = 0;
                totalVals = 0;
                
                allVars = [];
                allVals = [];

                function reset()
                {
                    document.getElementById("outputCode").innerHTML="";
                    totalVars = 0;
                    totalVals = 0;

                    allVars = [];
                    allVals = [];
                }                

                function assignmentFunc(statement)
                {
                   //x is from user;
                   //z is x plus y;
                   var tempArr = statement.split(" ");
                   
                   if(tempArr[2] == "from" )
                    {
                        allVars[totalVars] = tempArr[0];

                        var tempVal = prompt("Enter the value");
                        allVals[totalVals] = tempVal;

                    }

                    else if(tempArr.length > 4)
                    {
                        var arr = [];
                        var statement = "";

                        if(tempArr[3] == 'plus')
                        {
                            arr[0] = tempArr[2];
                            arr[1] = tempArr[3];
                            arr[2] = tempArr[4];

                            statement = arr.join(" ");
                            console.log("The statement is "+statement);
                            var tempVar = addFunc(statement);
                            console.log("The result is "+tempVar);

                            allVars[totalVars] = tempArr[0];
                            allVals[totalVals] = tempVar;
                        }

                        if(tempArr[3] == 'minus')
                        {
                            arr[0] = tempArr[2];
                            arr[1] = tempArr[3];
                            arr[2] = tempArr[4];

                            statement = arr.join(" ");
                            
                            var tempVar = minusFunc(statement);

                            allVars[totalVars] = tempArr[0];
                            allVals[totalVals] = tempVar;
                        }

                        if(tempArr[3] == 'mul')
                        {
                            arr[0] = tempArr[2];
                            arr[1] = tempArr[3];
                            arr[2] = tempArr[4];

                            statement = arr.join(" ");
                            
                            var tempVar = mulFunc(statement);

                            allVars[totalVars] = tempArr[0];
                            allVals[totalVals] = tempVar;
                        }

                        if(tempArr[3] == 'div')
                        {
                            arr[0] = tempArr[2];
                            arr[1] = tempArr[3];
                            arr[2] = tempArr[4];

                            statement = arr.join(" ");
                            
                            var tempVar = divFunc(statement);

                            allVars[totalVars] = tempArr[0];
                            allVals[totalVals] = tempVar;
                        }
                    }
                    else
                    {
                        allVars[totalVars] = tempArr[0];
                        allVals[totalVals] = tempArr[2]; 
                    }

                    totalVars += 1;
                    totalVals += 1;
                }

                function showFunc(statement)
                {
                    //Creating array and array variable for the purpose of storing quotes
                    var quotesArr = [];
                    var quotesVar = 0;

                    
                    //Splitting the array in characters so that it can easy to find tha index of quotes
                    var charArr = statement.split("");

                    
                    //Storing Locations of Quotes
                    for(var i = 0; i < charArr.length; i++)
                    {
                        if(charArr[i] == "\"")
                        {
                            //Storing the index of found quotes in charArr to quotesArr
                            quotesArr[quotesVar] = i;
                            //indication that quotes were found in the statement
                            quotesVar = quotesVar + 1;
                        }
                    }


                    var stringToShowArr = [];
                    var stringToShowVar = 0;

                    //if quotesVar is greater than 0 then it is the indication that there were more than one quotes
                    if(quotesVar > 0)
                    {
                        for(var k = 0; k<quotesArr.length; k+=2)
                        {
                            index1 = quotesArr[k];
                            index1 = index1 + 1;
                            console.log("index1:"+index1);
                            
                            index2 = quotesArr[k+1];
                            index2 = index2;
                            console.log("index2:"+index2);

                            stringToShowArr[stringToShowVar] = statement.substring(index1 , index2);

                            if( charArr.length >= index2+2 )
                            {
                              var variable = charArr[index2+2];
                              stringToShowVar++;
                              var pos = allVars.indexOf(variable);
                              stringToShowArr[stringToShowVar] = parseInt(allVals[pos]);
                              //stringToShowArr[stringToShowVar] = variable;
                            }

                            stringToShowVar++;
                            var result = "";
                            for(var j = 0; j < stringToShowArr.length ; j++)
                            {
                                result = result + stringToShowArr[j];
                            }

                            document.getElementById('outputCode').innerHTML = result;
                        }
                    }

                    else
                    {
                        var arr = statement.split(" ");

                        var pos = allVars.indexOf(arr[1]);

                        tempText = document.getElementById('outputCode').innerHTML; 
                        document.getElementById('outputCode').innerHTML = tempText+parseInt(allVals[pos])+"\n";
                    }
                     
                }

                function addFunc(statement)
                {
                    console.log(statement);
                    var arr = statement.split(" ");
                    console.log(arr);
                    var pos1 = allVars.indexOf(arr[0]);
                    var pos2 = allVars.indexOf(arr[2]);

                    pos1 = parseInt(allVals[pos1]);
                    pos2 = parseInt(allVals[pos2]);

                    var result = pos1 + pos2;
                    return result;
                }

                function minusFunc(statement)
                {
                    var arr = statement.split(" ");

                    var pos1 = allVars.indexOf(arr[0]);
                    var pos2 = allVars.indexOf(arr[2]);

                    pos1 = parseInt(allVals[pos1]);
                    pos2 = parseInt(allVals[pos2]);

                    var result = pos1 - pos2;
                    return result;
                }

                function mulFunc(statement)
                {
                    var arr = statement.split(" ");

                    var pos1 = allVars.indexOf(arr[0]);
                    var pos2 = allVars.indexOf(arr[2]);

                    pos1 = parseInt(allVals[pos1]);
                    pos2 = parseInt(allVals[pos2]);

                    var result = pos1 * pos2;
                    return result;
                }

                function divFunc(statement)
                {
                    var arr = statement.split(" ");

                    var pos1 = allVars.indexOf(arr[0]);
                    var pos2 = allVars.indexOf(arr[2]);

                    pos1 = parseInt(allVals[pos1]);
                    pos2 = parseInt(allVals[pos2]);

                    var result = pos1 / pos2;
                    return result;
                }

                function ifFunc(statement)
                {
                    //if x equals y
                        //result1 is number and result2 is number
                        //result1 is number and result2 is not a number
                        //result1 is not a number and result2 is a number
                        //result1 and result2 are not numbers

                    //if x greater than y
                    //if x greater than or equals y

                    //if x less than y
                    //if x less than or equals y

                    //if x not equals y

                    //if 1 equals 1 perform show x,;
                    var flag;
                    
                    if(statement.indexOf("equals") == 5 && statement.search("or") < 0)
                    {
                        console.log("am in");
                        var arr = statement.split(" ");
                        
                        //if x greater than y

                        if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[3])) == false )
                        {
                            if( parseInt(arr[1]) == parseInt(arr[3]) )
                            {
                                console.log("1:True");
                                flag = true;
                                console.log(flag);

                                //return true;
                            }
                            else
                            {
                                console.log("1:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[3])) == true )
                        {
                            
                            var pos2 = allVars.indexOf(arr[3]);
                            pos2 = parseInt(allVals[pos2]);

                            if( parseInt(arr[1]) == pos2 )
                            {
                                console.log("2:True");
                                flag = true;
                                return true;  
                            }
                            else
                            {
                                console.log("2:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[3])) == false )
                        {
                            
                            var pos1 = allVars.indexOf(arr[1]);
                            pos1 = parseInt(allVals[pos1]);

                            if( pos1 == parseInt(arr[3]) )
                            {
                                console.log("3:True");
                                flag = true;
                                return true; 
                            }
                            else
                            {
                                console.log("3:False");
                                flag = false;
                                return false;
                            }
                        }

                        //else if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[3])) == true )
                        else
                        {
                            var pos1 = allVars.indexOf(arr[1]);
                            var pos2 = allVars.indexOf(arr[3]);

                            pos1 = parseInt(allVals[pos1]);
                            pos2 = parseInt(allVals[pos2]);

                            if( pos1 == pos2 )
                            {
                                console.log("4:True");
                                flag = true;
                                return true; 
                            }
                            else 
                            {
                                console.log("4:False");
                                flag = false;
                                return false;
                            }
                        }
                    }

                    if(statement.indexOf("greater") == 5 && statement.search("or") < 0)
                    {
                        var arr = statement.split(" ");
                        //if x greater than y

                        if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[4])) == false )
                        {
                            if( parseInt(arr[1]) > parseInt(arr[4]) )
                            {
                                console.log("1:True");
                                flag = true;
                                return true;
                            }
                            else
                            {
                                console.log("1:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[4])) == true )
                        {

                            var pos2 = allVars.indexOf(arr[4]);
                            pos2 = parseInt(allVals[pos2]);

                            if( parseInt(arr[1]) > pos2 )
                            {
                                console.log("2:True");
                                flag = true;
                                return true;  
                            }
                            else
                            {
                                console.log("2:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[4])) == false )
                        {
                            
                            var pos1 = allVars.indexOf(arr[1]);
                            pos1 = parseInt(allVals[pos1]);

                            if( pos1 > parseInt(arr[4]) )
                            {
                                console.log("3:True");
                                flag = true;
                                return true; 
                            }
                            else
                            {
                                console.log("3:False");
                                flag = false;
                                return false;
                            }
                        }

                        //else if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[4])) == true )
                        else
                        {
                            var pos1 = allVars.indexOf(arr[1]);
                            var pos2 = allVars.indexOf(arr[4]);

                            pos1 = parseInt(allVals[pos1]);
                            pos2 = parseInt(allVals[pos2]);

                            if( pos1 > pos2 )
                            {
                                console.log("4:True");
                                flag = true;
                                return true; 
                            }
                            else 
                            {
                                console.log("4:False");
                                flag = false;
                                return false;
                            }
                        }
                    }

                    if(statement.indexOf("less") == 5 && statement.search("or") < 0)
                    {
                        var arr = statement.split(" ");
                        //if x greater than y

                        if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[4])) == false )
                        {
                            if( parseInt(arr[1]) < parseInt(arr[4]) )
                            {
                                console.log("1:True");
                                flag = true;
                                return true;
                            }
                            else
                            {
                                console.log("1:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[4])) == true )
                        {

                            var pos2 = allVars.indexOf(arr[4]);
                            pos2 = parseInt(allVals[pos2]);

                            if( parseInt(arr[1]) < pos2 )
                            {
                                console.log("2:True");
                                flag = true;
                                return true;  
                            }
                            else
                            {
                                console.log("2:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[4])) == false )
                        {
                            
                            var pos1 = allVars.indexOf(arr[1]);
                            pos1 = parseInt(allVals[pos1]);

                            if( pos1 < parseInt(arr[4]) )
                            {
                                console.log("3:True");
                                flag = true;
                                return true; 
                            }
                            else
                            {
                                console.log("3:False");
                                flag = false;
                                return false;
                            }
                        }

                        //if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[4])) == true )
                        else
                        {
                            var pos1 = allVars.indexOf(arr[1]);
                            var pos2 = allVars.indexOf(arr[4]);

                            pos1 = parseInt(allVals[pos1]);
                            pos2 = parseInt(allVals[pos2]);

                            if( pos1 < pos2 )
                            {
                                console.log("4:True");
                                flag = true;
                                return true; 
                            }
                            else 
                            {
                                console.log("4:False");
                                flag = false;
                                return false;
                            }
                        }
                    }

                    if(statement.indexOf("not") == 5 && statement.index("equals") == 9)
                    {
                        var arr = statement.split(" ");
                        //if x not equals than y

                        if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[5])) == false )
                        {
                            if( parseInt(arr[1]) != parseInt(arr[5]) )
                            {
                                console.log("1:True");
                                flag = true;
                                return true;
                            }
                            else
                            {
                                console.log("1:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[5])) == true )
                        {
                            
                            var pos2 = allVars.indexOf(arr[5]);
                            pos2 = parseInt(allVals[pos2]);

                            if( parseInt(arr[1]) != pos2 )
                            {
                                console.log("2:True");
                                flag = true;
                                return true;  
                            }
                            else
                            {
                                console.log("2:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[5])) == false )
                        {
                            
                            var pos1 = allVars.indexOf(arr[1]);
                            pos1 = parseInt(allVals[pos1]);

                            if( pos1 != parseInt(arr[5]) )
                            {
                                console.log("3:True");
                                flag = true;
                                return true; 
                            }
                            else
                            {
                                console.log("3:False");
                                flag = false;
                                return false;
                            }
                        }

                        //if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[5])) == true )
                        else
                        {
                            var pos1 = allVars.indexOf(arr[1]);
                            var pos2 = allVars.indexOf(arr[5]);

                            pos1 = parseInt(allVals[pos1]);
                            pos2 = parseInt(allVals[pos2]);

                            if( pos1 != pos2 )
                            {
                                console.log("4:True");
                                flag = true;
                                return true; 
                            }
                            else 
                            {
                                console.log("4:False");
                                flag = false;
                                return false;
                            }
                        }
                    }

                    if(statement.indexOf("greater") == 5 && statement.indexOf("equals") == 21)
                    {
                        var arr = statement.split(" ");
                        //if x greater than or equals y

                        if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[6])) == false )
                        {
                            if( parseInt(arr[1]) >= parseInt(arr[6]) )
                            {
                                console.log("1:True");
                                flag = true;
                                return true;
                            }
                            else
                            {
                                console.log("1:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[6])) == true )
                        {

                            var pos2 = allVars.indexOf(arr[6]);
                            pos2 = parseInt(allVals[pos2]);

                            if( parseInt(arr[1]) >= pos2 )
                            {
                                console.log("2:True");
                                flag = true;
                                return true;  
                            }
                            else
                            {
                                console.log("2:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[6])) == false )
                        {
                            
                            var pos1 = allVars.indexOf(arr[1]);
                            pos1 = parseInt(allVals[pos1]);

                            if( pos1 >= parseInt(arr[6]) )
                            {
                                console.log("3:True");
                                flag = true;
                                return true; 
                            }
                            else
                            {
                                console.log("3:False");
                                flag = false;
                                return false;
                            }
                        }

                        //if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[6])) == true )
                        else
                        {
                            var pos1 = allVars.indexOf(arr[1]);
                            var pos2 = allVars.indexOf(arr[6]);

                            pos1 = parseInt(allVals[pos1]);
                            pos2 = parseInt(allVals[pos2]);

                            if( pos1 >= pos2 )
                            {
                                console.log("4:True");
                                flag = true;
                                return true; 
                            }
                            else 
                            {
                                console.log("4:False");
                                flag = false;
                                return false;
                            }
                        }
                    }

                    //if x less than y
                    //if x less than or equals y

                    if(statement.indexOf("less") == 5 && statement.indexOf("equals") == 18)
                    {
                        var arr = statement.split(" ");
                        //if x greater than y

                        if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[6])) == false )
                        {
                            if( parseInt(arr[1]) <= parseInt(arr[6]) )
                            {
                                console.log("1:True");
                                flag = true;
                                return true;
                            }
                            else
                            {
                                console.log("1:False");
                                flag = true;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == false && isNaN(parseInt(arr[6])) == true )
                        {

                            var pos2 = allVars.indexOf(arr[6]);
                            pos2 = parseInt(allVals[pos2]);

                            if( parseInt(arr[1]) <= pos2 )
                            {
                                console.log("2:True");
                                flag = true;
                                return true;  
                            }
                            else
                            {
                                console.log("2:False");
                                flag = false;
                                return false;
                            }
                        }

                        else if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[6])) == false )
                        {
                            
                            var pos1 = allVars.indexOf(arr[1]);
                            pos1 = parseInt(allVals[pos1]);

                            if( pos1 <= parseInt(arr[6]) )
                            {
                                console.log("3:True");
                                flag = true;
                                return true; 
                            }
                            else
                            {
                                console.log("3:False");
                                flag = false;
                                return false;
                            }
                        }

                        //if( isNaN(parseInt(arr[1])) == true && isNaN(parseInt(arr[6])) == true )
                        else
                        {
                            var pos1 = allVars.indexOf(arr[1]);
                            var pos2 = allVars.indexOf(arr[6]);

                            pos1 = parseInt(allVals[pos1]);
                            pos2 = parseInt(allVals[pos2]);

                            if( pos1 <= pos2 )
                            {
                                console.log("4:True");
                                flag = true;
                                return true; 
                            }
                            else 
                            {
                                console.log("4:False");
                                flag = false;
                                return false;
                            }
                        }
                    }

                    //if 1 equals 1 do show x,; 
                    console.log(flag);
                    if(flag == true)
                    {
                        var index1 = statement.indexOf("do");
                        index1 = index1 + 3;
                            
                        var index2 = statement.lastIndexOf(",");
                        var work = statement.substring(index1 , index2);
                        console.log(work);

                        work = work.split(",");
                        console.log(work);


                        var forStatement;
                        console.log(work.length);

                        for(var j = 0; j <= work.length-1; j++)
                        {
                            forStatement = work[j];
                            console.log(forStatement);

                            if(forStatement.search("show") >= 0)
                            {
                                
                                showFunc(forStatement);
                            }

                            if(forStatement.search("is") >= 0)
                            {
                                assignmentFunc(forStatement);
                            }

                            else if(forStatement.search("plus") >= 0)
                            {
                                addFunc(forStatement);
                            }

                            else if(forStatement.search("minus") >= 0)
                            {
                                minusFunc(forStatement);
                            }

                            else if(forStatement.search("div") >= 0)
                            {
                                divFunc(forStatement);
                            }

                            if(forStatement.search("mul") >= 0)
                            {
                                mulFunc(forStatement);
                            }

                            if(forStatement.search("if") >= 0)
                            {
                                ifFunc(forStatement);
                            }

                            if(forStatement.search("keep") >= 0)
                            {
                                console.log("loop");
                                doFunc(forStatement);
                            }
                        }
                    }
                }    

                function doFunc(statement)
                {
                    //keep doing x is z plus 1 for 10 times;
                    var counter;
                    var index1;
                    var index2;

                    index1 = statement.indexOf("doing");
                    index1 = index1 + 6;

                    index2 = statement.indexOf("for");
                    index2 = index2 - 1;

                    work = statement.substring(index1 , index2);

                    index1 = statement.indexOf("for");
                    index1 = index1 + 4;

                    index2 = statement.indexOf("times");
                    index2 = index2 - 1;

                    var counter = statement.substring(index1 , index2);
                    counter = parseInt(counter);

                    work = work.split(",");
                    var forStatement;

                    for(var i = 1; i <= counter; i+=1)
                    {
                        
                        for(var j = 0; j <= work.length-2; j++)
                        {
                            forStatement = work[j];
                            console.log(forStatement);

                            if(forStatement.search("show") >= 0)
                            {
                                
                                showFunc(forStatement);
                            }

                            if(forStatement.search("is") >= 0)
                            {
                                assignmentFunc(forStatement);
                            }

                            else if(forStatement.search("plus") >= 0)
                            {
                                addFunc(forStatement);
                            }

                            else if(forStatement.search("minus") >= 0)
                            {
                                minusFunc(forStatement);
                            }

                            else if(forStatement.search("div") >= 0)
                            {
                                divFunc(forStatement);
                            }

                            if(forStatement.search("mul") >= 0)
                            {
                                mulFunc(forStatement);
                            }

                            if(forStatement.search("if") >= 0)
                            {
                                ifFunc(forStatement);
                            }

                            if(forStatement.search("keep") >= 0)
                            {
                                console.log("loop");
                                doFunc(forStatement);
                            }
                        }
                    }
                }

                function turnFunc(statement)
                {
                    var arr = statement.split(" ");
                    if( arr[1] == 'right')
                    {
                        console.log("turn right");
                        r.turnRight();
                    }

                    if( arr[1] == 'left')
                    {
                        console.log("move left");
                        r.turnLeft();
                    }
                }   

                function runCode()
                {
                    reset();

                    var str = document.getElementById("inputCode").value;
                    var arr = str.split(";");

                    var statement;

                    for(var i = 0; i <= arr.length-2; i++)
                    {
                       statement = arr[i];

                       if(statement.search("show") >= 0 && statement.search("show") <= 3)
                       {
                            showFunc(statement);
                       }

                       if(statement.search("is") > 1 && statement.search("is") <= 3)
                       {
                            assignmentFunc(statement);
                       }

                       else if(statement.search("plus") > 6 && statement.search("plus") < 11)
                       {
                            addFunc(statement);
                       }

                       else if(statement.search("minus") > 6 && statement.search("minus") < 12)
                       {
                            minusFunc(statement);
                       }

                       else if(statement.search("div") > 6 && statement.search("div") < 10)
                       {
                            divFunc(statement);
                       }

                       if(statement.search("mul") > 6 && statement.search("mul") < 10)
                       {
                            mulFunc(statement);
                       }

                       if(statement.search("if") >= 0 && statement.search("if") < 2)
                       {
                        ifFunc(statement);
                       }

                       if(statement.search("keep") >= 0 && statement.search("keep") < 5)
                       {
                        doFunc(statement);
                       }

                       if(statement.search("turn") >=0)
                       {
                        turnFunc(statement);
                       }
                    }
                }
                //keep doing show x, for 2 times
            </script> -->
    </body>

    

</html>