document.getElementById("catForm").addEventListener("submit", async (event) => {
    event.preventDefault();

    const name = document.getElementById("name").value;
    const color = document.getElementById("color").value;
    const data = {
        name: name,
        color: color
    };
    const url = "http://localhost:8000/cats";
    const options = {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    };
    
    const response = await fetch(url, options)
    const cat = await response.json();
    
    console.log(cat);
    console.log("Aiden rules front end!");
    
})