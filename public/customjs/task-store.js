$(function () {

    var task = {

        init : function () {
            this.setDOMElements();
            this.setElementEvents();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        },

        setDOMElements : function () {
            this.oBtnTaskCreate = $('#btn-task-create');
            this.oOptBuild = $('#optBuild');
            this.oTxtTaskId = $('#txtTaskId');
            this.oOptIncidentType = $('#optIncidentType');
            this.oOptSeverity = $('#optSeverity');
            this.oDtStart = $('#dtStarted');
            this.oDtCompleted = $('#dtCompleted');
            this.oTxtDesc = $('#txtdesc');
        },

        setElementEvents : function () {
            this.oBtnTaskCreate.on('click', task.taskCreate);
        },

        taskCreate : function () {
            var iBuildId = task.oOptBuild.val();
            var sTaskId = task.oTxtTaskId.val();
            var sIncType = task.oOptIncidentType.val();
            var sSeverity = task.oOptSeverity.val();
            var sStartDate = task.oDtStart.val();
            var sCompletedDate = task.oDtCompleted.val();
            var sDesc = task.oTxtDesc.val();

            $.ajax({
                url: 'store',
                method: 'POST',
                data:{
                    iBuildId : iBuildId,
                    sTaskId : sTaskId,
                    sIncType : sIncType,
                    sSeverity : sSeverity,
                    sStartDate : sStartDate,
                    sCompletedDate : sCompletedDate,
                    sDesc : sDesc
                },
                success:function (data) {
                    alert(data.result === false ? data.message : 'Task Successfully Recorded.');
                    location.reload();
                }
            });
        }
    };
    task.init();
});
