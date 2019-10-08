function stopWatch() {
    var watch = document.getElementById('demo');
    watch.classList.add('bg-success');
    var minutesLeft = 0 ;
    var secondsLeft = 12;
    const time = setInterval(function() {
        secondsLeft -= 1;
        if(secondsLeft === -1 && minutesLeft !== 0 ) {
            minutesLeft -= 1;
            secondsLeft = 59;
        }
        watch.innerHTML = minutesLeft + ':' + secondsLeft;
        if(minutesLeft <= 2)
            watch.classList.add('bg-danger');
        if(secondsLeft < 10)
            watch.innerHTML =  minutesLeft + ':' + 0 + secondsLeft;
        else if(minutesLeft < 10)
            watch.innerHTML = '0' + minutesLeft + ':' + secondsLeft;
        if(minutesLeft < 10 && secondsLeft < 10)
            watch.innerHTML = '0' + minutesLeft + ':' + '0' + secondsLeft;
        if(minutesLeft === 0 && secondsLeft === 0) {
            clearInterval(time);
            // var answers = [];
            // var divs = document.getElementsByClassName('radio');
            // console.log(divs);

                let r = Array.from(document.querySelectorAll("radio"));


            // var radios =  document.querySelectorAll('input[type="radio"]');
            // for(var i = 0; i<radios.length; i++){
            //     if(radios[i].checked) {
            //         let answer = radios[i].getAttributeNode('value').value;
            //         answers.push(answer);
            //         console.log(answer);
            //     }
            //     let unchecked = radios[i].getAttributeNode('value').value = "0";
            //     answers.push(unchecked);
            //     console.log(unchecked);
            // }
            // radios.forEach(function (value, index) {
            //      var a = value.getAttributeNode('value').ownerElement.getAttributeNode('checked');
            //      console.log(a);
            // });
        }
    }, 100);
}
stopWatch();
