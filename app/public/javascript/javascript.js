$(document).ready(function() {

    let peticionFloor = {
        method: 'GET',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        }
    }

    let responseFloor = fetch('/index.php/floor', peticionFloor)
        .then(response => {
            return response.json();
        })
        .then(response => {
            //No ha ocurrido ningún error
            $("#from-floor").empty();
            $("#to-floor").empty();
            if (response.status == 500) {
                alert(response.detail);
            } else {
                let mainContainer = document.getElementById("from-floor");
                for (let i = 0; i < response.length; i++) {
                    mainContainer.appendChild(new Option(response[i].name, response[i].id));
                }

                mainContainer = document.getElementById("to-floor");
                for (let i = 0; i < response.length; i++) {
                    mainContainer.appendChild(new Option(response[i].name, response[i].id));
                }
            }
        });


    $('#send-request').click(function() {

        let peticionRequest = {
            method: 'POST',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                floor_from: parseInt($("#from-floor").val()),
                floor_to: parseInt($("#to-floor").val()),
            })
        };

        let peticionStatus = {
            method: 'GET',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            }
        }

        let responseStatusBefore = fetch('/index.php/elevator/status', peticionStatus)
            .then(response => {
                return response.json();
            })
            .then(response => {
                //No ha ocurrido ningún error
                $("#before").empty();
                if (response.status == 500) {
                    alert(response.detail);
                } else {
                    let mainContainer = document.getElementById("before");
                    for (let i = 0; i < response.length; i++) {
                        let div = document.createElement("div");
                        div.innerHTML = response[i].name + " - " + response[i].currentFloor.name;
                        mainContainer.appendChild(div);
                    }
                }
            });

        let response = fetch('/index.php/elevator/request', peticionRequest)
            .then(response => {
                return response.json();
            })
            .then(response => {
                console.log(response);
                //No ha ocurrido ningún error
                $("#post-send-request div").empty();
                if (response.status == 500) {
                    alert(response.detail);
                } else {
                    let mainContainer = document.getElementById("origin-call");
                    for (let i = 0; i < response.toOriginRequest.length; i++) {
                        let div = document.createElement("div");
                        div.innerHTML = response.toOriginRequest[i].name;
                        mainContainer.appendChild(div);
                    }

                    mainContainer = document.getElementById("call-destination");
                    for (let i = 0; i < response.toDestinationRequest.length; i++) {
                        div = document.createElement("div");
                        div.innerHTML = response.toDestinationRequest[i].name;
                        mainContainer.appendChild(div);
                    }

                    mainContainer = document.getElementById("elevator");
                    div = document.createElement("div");
                    div.innerHTML = response.elevator.name;
                    mainContainer.appendChild(div);

                    mainContainer = document.getElementById("count");
                    div = document.createElement("div");
                    div.innerHTML = "Cantidad de pisos " + response.countFloor;
                    mainContainer.appendChild(div);

                    let responseStatusAfter = fetch('/index.php/elevator/status', peticionStatus)
                        .then(response => {
                            return response.json();
                        })
                        .then(response => {
                            //No ha ocurrido ningún error
                            $("#after").empty();
                            if (response.status == 500) {
                                alert(response.detail);
                            } else {
                                let mainContainer = document.getElementById("after");
                                for (let i = 0; i < response.length; i++) {
                                    let div = document.createElement("div");
                                    div.innerHTML = response[i].name + " - " + response[i].currentFloor.name;
                                    mainContainer.appendChild(div);
                                }
                            }
                        });
                }
            });
        ;

    });

});