<!DOCTYPE html>
<html>

<head>
    <title>Similarity | Evan Genest</title>
    <meta charset="UTF-8">
  <link rel="icon" type="image/png" href="images/dryer.png" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
    <style type="text/css">
        /*
        I meant this page as a pure CSS learning exercise BUT it has BS. I'm mostly
        using Bootstrap as a style reset.  TODO: write by hand a re-set.
        */
    
            :root { 
                --lightGray: rgb(239, 239, 244); 
                --darkGray: rgb(76, 77, 75);
                --skyColor: rgb(124, 172, 255);
                --palerSky: rgb(165, 220, 255 );
                --infieldGreen: rgb(52, 147, 28);
                --tigersNavy: rgb(7, 23, 53);
            }
            header {
              display: flex;
              align-content: center;
            }

            h4.dashboard__text a {
              border-radius: 1rem;
              text-decoration: underline;

            }
            h4.dashboard__text a:hover  {
              xbackground-color: #444;
              text-decoration: none;
              margin-left: 0.15rem;
              margin-bottom: 0.15rem;
            }

            h4.dashboard__text a:focused  {
              background-color: #yellow;

            }

            img {
              width: 98%;
            }
            h2 {
              font-size: 1.45rem;
            }

            a {
              color: var(--infieldGreen);
              text-decoration: none;
              border: solid transparent 0.2rem;
            }
            h4 a {
                   color: white;
            }
            a:hover {
              background-color:  var(--tigersNavy);
              text-decoration: none;
              color: white !important;
            }
            .title__hoegarden {
              text-shadow: 1px 1px 2px black, 0 0 25px gray, 0 0 5px black;
              font-family: monospace;
              color: white;
              font-weight: 500;
              margin-left: 2rem;
            }
            
            .title__skinny {
              font-weight: 100;
              text-indent: 2.5rem;
              line-height: 2.6rem;
            }
            .title__explain {
                padding: 0.4rem 2rem;
            }
            .elShadow {
              box-shadow: 0 7px 7px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
              border: 0.1rem hidden;
              border-radius: 0.3rem;
            }
    
            
            .dashboard {
              border: 2px  white;
              margin: 0.5rem 2rem;
              background-color: var(--darkGray);
              color:  var(--lightGray) ;
              padding: 0.5rem;
            }
            
            .dashboard__text {
              margin: 0.3rem 1.5rem;
              color: white;
            }
            
            .dashboard__data-noneditable {
              color: black;
              background-color: #777;
            }
            
            .codeboard {
              border: 5px dashed #bbb;
              margin: 0.5rem 2rem;
              background-color: #222;
              padding: 0.5rem;
            }
            
            .codeboard__code {
              color: #aaf;
              margin: 0.3rem 1.5rem 0.3rem 1.9rem;
    
    
            }
            .block {
              background-color:  var(--lightGray)       ;
              margin: 1rem;
              padding: 2rem;
            }
    
            .navyBackground {
              background-color:  var(--tigersNavy);
              xcolor: white;
            }
    
            .greenBackground {
                  background-color:  var(--infieldGreen);
                  border-radius: 0.6rem;
                  padding: 0.1rem 0.3rem;
            }
    </style>
</head>

<body>
<header>
        <h1 class="title__hoegarden float-left">Similarity</h1>
        <h1 class="title__skinny float-left">Analyze a pair of text samples</h1>
</header>


    <section>
        <div class="col-md-9 outblock block elShadow" id="explanation">
          <h2>Notes on the method</h2>
            <p>I was given the following challenge: <br><span><code> Write a program that takes as inputs two file paths and uses a metric to determine how similar they are.  Documents that are exactly the same should get a score of 1, and documents that don’t have any words in common should get a score of 0.</code></span></p>
            <p>For the solution I avoided libraries or known algorithms and made a naive back of the envelope solution.  I reviewed the main strategy I learned at Hunter College for DNA testing, the <a href="https://binf.snipcademy.com/lessons/pairwise-alignment/global-needleman-wunsch">Needleman-Wunsch</a> algorithm, mostly because I couldn't quickly figure out how to implement it.  So my naive strategy is this:</p>
            <ol>
                <li>Take the two input strings, remove punctuation, spaces, and any non alpha chars, to create a pair of word arrays</li>
                <li>Tally any members of List 1 that do not occur in list 2.</li>
                <li>Repeat the orphan tally but in the reverse direction, tallying any members of List 1 that do not occur in list 2.</li>
                <li>Return a similiarity score: take the inverse of the average of orphans/allwords. So on a scale of 0 to 1, 1 represents utter disimilarity and 0 represents complete identity.</li>
            </ol>
            <p>To see my solution in detail, check out <a href="https://github.com/atom-box/codingBatJS/blob/master/helpers/textSimilarity.js"> its repository</a>.  To see the code running with comments, open the console of your browser, and then reload this page.</p>
        </div>
    </section>

<div class="col-md-9 outblock block elShadow" id="filter1">
    <h2>Analyze A versus B:</h2>

    <div class="dashboard output elShadow">
        <h4 class="dashboard__text">Text A</h4>
        <p class="dashboard__data-noneditable dashboard__text" id='1x'>12345
        </p>
    </div>        

    <div class="dashboard output elShadow">
        <h4 class="dashboard__text">Text B</h4>
        <p class="dashboard__data-noneditable dashboard__text" id='1y'>12345
        </p>
    </div>

    <div class="dashboard output elShadow">
        <h4 class="dashboard__text"><a  href="#explanation">Similarity </a></h4>
        <p class="dashboard__data-noneditable dashboard__text" id='1answer'>12345
        </p>
        
    </div>

</div>

<div class="col-md-9 outblock block elShadow" id="filter1">
    <h2>Analyze B versus C:</h2>

    <div class="dashboard output elShadow">
        <h4 class="dashboard__text">Text B</h4>
        <p class="dashboard__data-noneditable dashboard__text" id='2x'>12345
        </p>
    </div>        

    <div class="dashboard output elShadow">
        <h4 class="dashboard__text">Text C</h4>
        <p class="dashboard__data-noneditable dashboard__text" id='2y'>12345
        </p>
    </div>

    <div class="dashboard output elShadow">
        <h4 class="dashboard__text"><a  href="#explanation">Similarity </a></h4>
        <p class="dashboard__data-noneditable dashboard__text" id='2answer'>12345
        </p>
        
    </div>
</div>

<div class="col-md-9 outblock block elShadow" id="filter1">
    <h2>Analyze A versus C:</h2>

    <div class="dashboard output elShadow">
        <h4 class="dashboard__text">Text A</h4>
        <p class="dashboard__data-noneditable dashboard__text" id='3x'>12345
        </p>
    </div>        

    <div class="dashboard output elShadow">
        <h4 class="dashboard__text">Text C</h4>
        <p class="dashboard__data-noneditable dashboard__text" id='3y'>12345
        </p>
    </div>

    <div class="dashboard output elShadow">
        <h4 class="dashboard__text"><a  href="#explanation">Similarity </a></h4>
        <p class="dashboard__data-noneditable dashboard__text" id='3answer'>12345
        </p>
      
    </div>
</div>

<div class="col-md-9 outblock block elShadow" id="filter1">
    <h2>Analyze C versus C (should give perfect score):</h2>

    <div class="dashboard output elShadow">
        <h4 class="dashboard__text">Text C</h4>
        <p class="dashboard__data-noneditable dashboard__text" id='4x'>12345
        </p>
    </div>        

    <div class="dashboard output elShadow">
        <h4 class="dashboard__text">Text C</h4>
        <p class="dashboard__data-noneditable dashboard__text" id='4y'>12345
        </p>
    </div>

    <div class="dashboard output elShadow">
        <h4 class="dashboard__text"><a  href="#explanation">Similarity </a></h4>
        <p class="dashboard__data-noneditable dashboard__text" id='4answer'>12345
        </p>
        
    </div>
</div>





<div class="col-md-9 outblock block elShadow" id="filter1">
    <h2>Analyze A versus 'FOO BAR BAZ':</h2>

    <div class="dashboard output elShadow">
        <h4 class="dashboard__text">Text A</h4>
        <p class="dashboard__data-noneditable dashboard__text" id='5x'>12345
        </p>
    </div>        

    <div class="dashboard output elShadow">
        <h4 class="dashboard__text"></h4>
        <p class="dashboard__data-noneditable dashboard__text" id='5y'>12345
        </p>
    </div>

    <div class="dashboard output elShadow">
        <h4 class="dashboard__text"><a  href="#explanation">Similarity </a></h4>
        <p class="dashboard__data-noneditable dashboard__text" id='5answer'>12345
        </p>
        
    </div>
</div>

<div class="col-md-9 outblock block elShadow" id="filter1">
    <h2>Analyze "foo foo foo" versus "FOO BAR BAZ":</h2>

    <div class="dashboard output elShadow">
        <h4 class="dashboard__text">Text</h4>
        <p class="dashboard__data-noneditable dashboard__text" id='6x'>12345
        </p>
    </div>        

    <div class="dashboard output elShadow">
        <h4 class="dashboard__text">Text</h4>
        <p class="dashboard__data-noneditable dashboard__text" id='6y'>12345
        </p>
    </div>

    <div class="dashboard output elShadow">
        <h4 class="dashboard__text"><a  href="#explanation">Similarity </a></h4>
        <p class="dashboard__data-noneditable dashboard__text" id='6answer'>12345
        </p>
        
    </div>
</div>


        <div class="col-md-9 outblock block elShadow">
          <h2>Discussion</h2>
          <p>Some satisfying improvements to this project could include the following:</p>
          <ul>
            <li>rewrite the logic to follow the <a href="https://binf.snipcademy.com/lessons/pairwise-alignment/global-needleman-wunsch">Needleman-Wunsch</a> algorithm, common in gene alignment + BLAST</li>
            <li>Use a weighting in the score, considering words of less than 5 letters to count as less important in the scoring. So misaligned cases of <span><code>of, the, and 'a'</code></span>are penalized less than <span><code>smooth, pelican, and coelecanth</code></span>. This is not great, since strange members like <span><code>gnat, gnu, and ax</code></span> now become deemphasized content in the text.</li>
            <li>use some sort of library in the weighting, not word length</li>
            <li>add buttons to choose from possible texts to align.</li>
            <li>sanitize inputs; allow user-pasted or uploaded text</li>
            <li>deploy from a Node.js server</li>
            <li>write with React.js</li>
            <li>clean up the CSS borrowed from my old page</li>
          </ul>
        </div>

    <div class="col-md-9 outblock block elShadow">
        <footer>
            <div class="starboard">
                <span>Made by Evan Genest: </span>
                <i class="fab fa-github"></i>
                <a href="https://github.com/atom-box/"> Github </a>
                <i class="fab fa-twitter"></i>
                <a href="https://twitter.com/mistergenest"> Twitter </a>
                <i class="fab fa-linkedin"></i><a href="https://www.linkedin.com/in/evan-genest-b6648380"> LinkedIn </a><i class="fas fa-address-card"></i><a href="http://littlefurnace.com"> Portfolio </a> 
            </div>
        </footer>
    </div>

    <script src="./helpers/textSimilarity.js"  ></script>
</body>




</html>