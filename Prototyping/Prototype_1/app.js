// /* function to display child elements on click */
// var toggler = document.getElementsByClassName("container");
// var i;

// for (i = 0; i < toggler.length; i++) {
//   toggler[i].addEventListener("click", function() {
//     this.parentElement.querySelector(".nested").classList.toggle("active"); /* Toggle from nested to active */
//     // this.classList.toggle("check-box");
//   });
// }

/* function to display child elements on click */
$('input:checkbox').click(function () {    
    // $('.nested').show();
    if (this.parentElement.classList.contains("container")){
        this.parentElement.querySelector(".nested").classList.toggle("active"); /* Toggle from nested to active */
    }
    // console.log(this.parentElement.querySelector(".nested").classList.value);
    // if (this.classList.contains(".nested")){
    //     console.log("YES");
    // }    
    // console.log(this.parentElement);
    // if this.parentElement.classList
    // this.parentElement.querySelector(".nested").classList.toggle("active"); /* Toggle from nested to active */

});


let Conditions = {
    condition1: false,
    condition2: false,

    benefitA: function() {
        return {
            div: "#benefit_a",
            names: ["#condition1", "#condition2"],
            satisfied: (this.condition1 && this.condition2),
        };
    },

    benefitB: function() {
        return {
            div: "#benefit_b",
            names: ["#condition1", "#condition2"],
            satisfied: (this.condition1 && !this.condition2) || (!this.condition1 && this.condition2),
        };
    },

    benefits: function() {
        return [
            this.benefitA,
            this.benefitB
        ];
    }
};

// function display_sublist(checkbox_element) {

//     // Need to get the div that the checkbox_element is a part of

//     if (checkbox_element.checked){
//         alert("hi")
//         // $('#page1').hide();
//         // $('#page2').show();
//     }else{
//         alert("bye");
//     }
// }

// Syntax for a self-invoking function:
// (function() {
//    // code
// })();


(function() {

    $('#page1form').on('submit', function(e) {
        e.preventDefault();

        Conditions.condition1 = $('#condition1').prop('checked');
        Conditions.condition2 = $('#condition2').prop('checked');
        console.log($('#condition1').prop('checked'));
        console.log($('#condition2').prop('checked'));
        console.log(Conditions.condition1);
        console.log(Conditions.condition2);       

        for (const benefit of Conditions.benefits()) {
            const result = benefit();
            if (result.satisfied) {
                $(result.div).show();
            } else {
                $(result.div).hide();
            }
            for (let name of result.names) {
                $("#page2 " + name + "_benefit")
                    .prop('checked', $("#page1 " + name).prop('checked'))
                    .prop('disabled', true);
            }
        }

        $('#page1').hide();
        $('#page2').show();
    });

    $('#page2 .back').on('click', function(e) {
        e.preventDefault();
        $('#page2').hide();
        $('#page1').show();
    });
}());
