const toDoList = document.getElementById("to-do-list")
const toDoListItems = Array.from(document.getElementsByClassName("list-item--to-do"))
const completedToDoList = document.getElementById("completed-to-do-list")
const accordionButtons = Array.from(document.getElementsByClassName("tracker__button--accordion"))
const confirmButtons = Array.from(document.getElementsByClassName("tracker__button--confirm"))

document.addEventListener("DOMContentLoaded",function(){

  function removeToDo(){
    toDoListItems.forEach(function(item){
      item.addEventListener("click", function(){

        let listItem = document.createElement("li")
        let listItemContent = this.querySelector("label").textContent
        listItem.append(listItemContent)
        listItem.classList.add("list-item", "list-item--complete")
        completedToDoList.append(listItem)

        this.remove();
      })
    })
  }

  function toggleAccordion(){
    accordionButtons.forEach(function(button){
      button.addEventListener("click", function(){
        this.classList.toggle("open")
        this.closest(".tracker__accordion").classList.toggle("open")
      })
    })
  }

  function updateButton(){
    confirmButtons.forEach(function(button){
      button.addEventListener("click", function(){
        event.preventDefault();
        button.classList.add("confirmed")
        if(button.id == "update-button"){
          button.innerHTML = "Checked!"
          setTimeout(function(){
            button.classList.remove("confirmed")
            button.innerHTML = "Check Updates"
          }, 10000)
        }else if(button.id == "useful-button"){
          button.innerHTML = "Thanks!"
        }
      })
    })
  }

  removeToDo();
  toggleAccordion();
  updateButton();
});