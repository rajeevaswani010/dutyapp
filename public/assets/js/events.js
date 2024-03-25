
function createUserAssignedEvent(userid,missionid){
    return new CustomEvent("userassigned", {
        detail: {
            userid:userid,
            missionid:missionid
        },
        bubbles: true,
        cancelable: true,
        composed: false,
    });
}

