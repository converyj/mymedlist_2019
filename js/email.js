
function mailTo(email, subject) {
    // var list = document.getElementById('myList');
    $.ajax({
             type: 'POST',
             url: "create-pdf.php",
             data: {
                medlist: list 
                },
             success: function(response) {
                 console.log(response)
             }
         })
}


// var btn = document.getElementById('#mail');


    
function pdf() {
    html2canvas(document.querySelector("#myList")).then(canvas => {
        document.body.appendChild(canvas)
    });
    // html2canvas(document.querySelector("#myList"),  {
    //         onrendered: function(canvas) {
    //             document.boody.appendChild(canvas)
    //             // const img = canvas.toDataURL('image/png')
    //             // const pdf = new jsPDF()
    //             // // pdf.addImage(imgData, 'JPEG', 0, 0, width, height)
    //             // pdf.save('medlist.pdf');
    //         }
    //     });
    
        // html2canvas(document.getElementById('myList'), { 
        //     onrendered: function(canvas) {
        //         var doc = new jsPDF();

        //     // var speciaElementHandlers = {
        //     //     '#hidePDF': function(element, render) { return true;}
        //     // };
        //     doc.fromHTML($('#toPDF').html(), 15, 15, {
        //         'width': 150,
        //         'elementHandlers': speciaElementHandlers
        //     });

        //     setTimeout(function(){
        //         doc.save('medlist.pdf');
        //         },2000);
        //         }
        //     });
        }
         
        //  var x = window.open();
        //  x.document.open();
        //  x.document.location=pdf;
        //  console.log(pdf); 

        //  
        // }
   
