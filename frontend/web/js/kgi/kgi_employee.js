var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == "localhost") {
     $baseUrl = window.location.protocol + "//" + window.location.host + "/HRVC/frontend/web/";
} else {
     $baseUrl = window.location.protocol + "//" + window.location.host + "/";
}
$url = $baseUrl;
function prepareDeleteKgiEmployee(kgiEmployeeId) {
     $("#kgiEmployeeId-modal").val(kgiEmployeeId);
}
function deleteKgiEmployee() {
     var kgiEmployeeId = $("#kgiEmployeeId-modal").val();
     // alert(kgiEmployeeId);
     var url = $url + "kgi/kgi-personal/delete-kgi-employee";
     $.ajax({
          type: "POST",
          dataType: "json",
          url: url,
          data: { kgiEmployeeId: kgiEmployeeId },
          success: function (data) {
               if (data.status) {
                    $("#delete-kgi-employee").modal("hide");
                    $("#kgi-employee-" + kgiEmployeeId).hide();
               }
          },
     });
}
function kgiFilterForEmployee() {
     var month = $("#month-filter").val();
     var status = $("#status-filter").val();
     var year = $("#year-filter").val();
     var companyId = $("#company-filter").val();
     var branchId = $("#branch-filter").val();
     var teamId = $("#team-filter").val();
     var type = $("#type").val();
     var employeeId = $("#employee-filter").val();
     var url = $url + "kgi/kgi-personal/search-kgi-personal";
     showLoading();
     $.ajax({
          type: "POST",
          dataType: "json",
          url: url,
          data: { companyId: companyId, branchId: branchId, teamId: teamId, month: month, status: status, year: year, type: type, employeeId: employeeId },
          success: function (data) {},
     });
}

$(document).ready(function () {
     $(document).on("keydown", ".numberOnly", function (e) {
          var oneDot = 1;
          var number = 1;
          var symbol = 1;
          if (e.key === "." || e.keyCode === 190 || e.keyCode === 110) {
               if ($(this).val().indexOf(".") === -1) {
                    if ($(this).val() === "") {
                         oneDot = 0;
                    }
               } else {
                    oneDot = 0;
               }
          }
          if (
               (e.keyCode >= 48 && e.keyCode <= 57) || // แถวบนคีย์บอร์ด
               (e.keyCode >= 96 && e.keyCode <= 105)
          ) {
               // Numpad
               number = 1;
          } else {
               if (
                    $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || // key ที่อนุญาตพิเศษ เช่น Backspace, Delete, Tab, Escape, Enter, ลูกศร
                    // Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                    (e.keyCode === 65 && (e.ctrlKey || e.metaKey)) ||
                    (e.keyCode === 67 && (e.ctrlKey || e.metaKey)) ||
                    (e.keyCode === 86 && (e.ctrlKey || e.metaKey)) ||
                    (e.keyCode === 88 && (e.ctrlKey || e.metaKey)) ||
                    // home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)
               ) {
                    symbol = 1;
               } else {
                    number = 0;
                    symbol = 0;
               }
          }

          if (number === 0 || oneDot === 0 || symbol === 0) {
               e.preventDefault();
          } else {
               return;
          }
     });
     $(".numberOnly").on("paste", function (e) {
          let pasteData = (e.originalEvent || e).clipboardData.getData("text");

          // regex: อนุญาตเฉพาะตัวเลข และจุดทศนิยมครั้งเดียว
          if (!/^\d*\.?\d*$/.test(pasteData)) {
               e.preventDefault();
          }
     });
     $(".teamTarget").on("keydown", function (e) {
          if (e.key == "Enter") {
               let currentIndex = $(".teamTarget").index(this);
               let nextIndex = currentIndex + 1;
               var currentId = $(this).attr("id");
               var teamId = currentId.split("-")[1];

               if ($(this).val() !== "") {
                    if ($(this).val().includes(".")) {
                         if (/\.\d+/.test($(this).val()) == false) {
                              $("#teamTarget-" + teamId).val($(this).val().split(".")[0]); //ถ้าหลัง . ไม่มีตัวเลข
                         }
                    }
                    $("#team-" + teamId).prop("checked", true);
               } else {
                    $("#team-" + teamId).prop("checked", false);
               }
               if ($(".teamTarget").eq(nextIndex) !== -1) {
                    $(".teamTarget").eq(nextIndex).focus();
               }
               e.preventDefault();
          }
     });
     $(document).on("keydown", ".employeeTarget", function (e) {
          if (e.key == "Enter") {
               let currentIndex = $(".employeeTarget").index(this);
               let nextIndex = currentIndex + 1;
               var currentId = $(this).attr("id");
               var employeeId = currentId.split("-")[2];
               if ($(this).val() !== "") {
                    if ($(this).val().includes(".")) {
                         if (/\.\d+/.test($(this).val()) == false) {
                              $("#employee-target-" + employeeId).val($(this).val().split(".")[0]); //ถ้าหลัง . ไม่มีตัวเลข
                         }
                    }
                    $("#employee-" + employeeId).prop("checked", true);
               } else {
                    $("#employee-" + employeeId).prop("checked", false);
               }

               $("#nextIndex").val(nextIndex);
               $("#employee-remark-" + employeeId).focus();
               e.preventDefault();
          }
     });
     $("#update-kgi-team-employee").on("keydown", function (e) {
          if (e.key == "Enter" && $(e.target).is(".assign-target")) {
               e.preventDefault();
          }
     });
     $("#update-kpi-team-employee").on("keydown", function (e) {
          if (e.key == "Enter" && $(e.target).is(".assign-target")) {
               e.preventDefault();
          }
     });
});
function assignKgiToEmployeeInTeam(teamId, kgiId) {
     //เมื่อคลิกที่ checkbox
     var url = $url + "kgi/assign/employee-in-team-target";
     var month = $("#month").val();
     var year = $("#year").val();
     if ($("#team-" + teamId).prop("checked") == true) {
          $.ajax({
               type: "POST",
               dataType: "json",
               url: url,
               data: { teamId: teamId, kgiId: kgiId, year: year, month: month },
               success: function (data) {
                    if (data.status) {
                         $("#team-employee-target").append(data.textHtml);
                    }
               },
          });
     } else {
          $("#team-employee-" + teamId).remove();
          $("#employee-in-team-" + teamId).remove();
     }
}
function calculateEmployeeTargetValue(e, teamId) {
     //เมื่อปล่อยปุ่ม
     var total = 0;
     var inputVal = $("#teamTarget-" + teamId).val();
     if ($("#team-" + teamId).is(":checked") == false && inputVal !== "") {
          $("#team-" + teamId).prop("checked", true);
     } else {
          if (inputVal == "") {
               if (e.key !== "Enter") {
                    $("#team-" + teamId).prop("checked", false);
               }
          }
          $(".employee-target-" + teamId).each(function () {
               if ($(this).val() != "") {
                    let currentValue = $(this).val().replace(",", "");
                    total = total + parseFloat(currentValue);
               }
          });
     }
     $("#total-team-target-" + teamId).html(total.toLocaleString("en-US", { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
}
function updateEmployeeTerget(e, teamId, employeeId) {
     var total = 0;
     var inputVal = $("#employee-target-" + employeeId).val();
     if ($("#employee-" + employeeId).is(":checked") == false && inputVal !== "") {
          $("#employee-" + employeeId).prop("checked", true);
     } else {
          if (inputVal == "") {
               if (e.key !== "Enter") {
                    $("#employee-" + employeeId).prop("checked", false);
               }
          }
          $(".employee-target-" + teamId).each(function () {
               if ($(this).val() != "") {
                    let currentValue = $(this).val().replace(",", "");
                    total = total + parseFloat(currentValue);
               }
          });
     }
     $("#total-team-target-" + teamId).html(total.toLocaleString("en-US", { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
}

function checkEnter(event, teamId, index) {
     if (event.key === "Enter") {
          var nextIndex = index + 1;
          $(".employee-" + teamId + "-" + nextIndex).focus();
          event.preventDefault();
     }
}
function checkEnterTextArea(event, employeeId, teamId, current) {
     if (event.key === "Enter") {
          event.preventDefault();
          var next = current + 1;
          if ($("#target-employee-" + employeeId).prop("checked")) {
          } else {
               $("#target-employee-" + employeeId).prop("checked", true);
          }
          $(".input-" + teamId + "-" + next).focus();
     }
}

function showEmployeeTeamTarget(teamId) {
     $("#employee-in-team-" + teamId).show();
     $("#show-" + teamId).hide();
     $("#hide-" + teamId).show();
}
function hideEmployeeTeamTarget(teamId) {
     $("#employee-in-team-" + teamId).hide();
     $("#show-" + teamId).show();
     $("#hide-" + teamId).hide();
}
function viewTabEmployeeKgi(kgiEmployeeHistoryId, tabId, kgiId, kgiEmployeeId) {
     var currentTabId = $("#currentTab").val();
     var kgiId = $("#kgiId").val();
     $("#tab-" + currentTabId).removeClass("view-tab-active");
     $("#tab-" + currentTabId).addClass("view-tab");
     $("#tab-" + tabId).removeClass("view-tab");
     $("#tab-" + tabId).addClass("view-tab-active");
     $("#tab-" + currentTabId + "-blue").hide();
     $("#tab-" + currentTabId + "-black").show();
     $("#tab-" + tabId + "-blue").show();
     $("#tab-" + tabId + "-black").hide();
     $("#currentTab").val(tabId);
     if (tabId == 1) {
          var url = $url + "kgi/kgi-personal/kgi-team-employee";
          $.ajax({
               type: "POST",
               dataType: "json",
               url: url,
               data: { kgiId: kgiId, kgiEmployeeHistoryId: kgiEmployeeHistoryId, kgiEmployeeId: kgiEmployeeId },
               success: function (data) {
                    $("#show-content").html(data.kgiEmployeeTeam);
                    if (viewType == "list") {
                         $("#man-check").css("display", "none");
                         $("#all").show();
                         $("#employee-all").show();
                         $("#kgi-employee").css("display", "none");
                         $("#viewType").val("list");
                    }
               },
          });
     }
     if (tabId == 2) {
          var url = $url + "kgi/kgi-personal/all-kgi-history";
          $.ajax({
               type: "POST",
               dataType: "json",
               url: url,
               data: { kgiEmployeeId: kgiEmployeeId, kgiEmployeeHistoryId: kgiEmployeeHistoryId },
               success: function (data) {
                    $("#show-content").html(data.monthlyDetailHistoryText);
               },
          });
     }
     if (tabId == 3) {
          var url = $url + "kgi/view/kgi-issue";
          $.ajax({
               type: "POST",
               dataType: "json",
               url: url,
               data: { kgiId: kgiId },
               success: function (data) {
                    $("#show-content").html(data.kgiIssue);
               },
          });
     }
     if (tabId == 4) {
          //alert(kgiTeamId);
          var url = $url + "kgi/kgi-personal/kgi-employee-chart";
          $.ajax({
               type: "POST",
               dataType: "json",
               url: url,
               data: { kgiEmployeeId: kgiEmployeeId, kgiEmployeeHistoryId: kgiEmployeeHistoryId, kgiId: kgiId },
               success: function (data) {
                    $("#show-content").html(data.kgiChart);
               },
          });
     }
     if (tabId == 5) {
          var url = $url + "kgi/view/kgi-kpi";
          $.ajax({
               type: "POST",
               dataType: "json",
               url: url,
               data: { kgiId: kgiId },
               success: function (data) {
                    $("#show-content").html(data.kpi);
               },
          });
     }
}
function validateFormKgiEmployee() {
     var fromDate = document.getElementById("fromDate").value.trim();
     var toDate = document.getElementById("toDate").value.trim();
     var nextDate = $("#nextDate").val();
     if (!fromDate && !toDate) {
          $("#due-term-message").removeClass("invisible");
          $("#multi-due-term").addClass("not-valid");
          return false;
     } else if (!fromDate || fromDate == "Start") {
          $("#due-term-message").removeClass("invisible");
          $("#multi-due-term").addClass("not-valid");
          return false;
     } else if (!toDate || toDate == "End") {
          $("#due-term-message").removeClass("invisible");
          $("#multi-due-term").addClass("not-valid");
          return false;
     } else if (nextDate == "") {
          $("#last-update-message").removeClass("invisible");
          $("#multi-due-update").addClass("not-valid");
          return false;
     } else if ($("#check1").prop("checked") == false && $("#check2").prop("checked") == false) {
          alert("Please check the status");
          return false;
     } else {
          return true;
     }
}
function showTeamEmployee1(teamId) {
     var teamStr = $("#allTeam1").val();
     var teamArr = teamStr.split(",");
     var currentTeam1 = $("#currentTeam1").val();
     if (teamId != currentTeam1) {
          $.each(teamArr, function (index, value) {
               if (value != "" && value != teamId) {
                    $("#team1-" + value).css("display", "none");
                    $("#employee1-" + value).css("display", "none");
                    $("#selectTeam1-" + value).removeClass("selectedTeam");
                    $("#selectTeam1-" + value).addClass("bg-white");
               }
          });
          $("#team1-" + teamId).show();
          $("#employee1-" + teamId).show();
          $("#selectTeam1-" + teamId).removeClass("bg-white");
          $("#selectTeam1-" + teamId).addClass("selectedTeam");
          $("#currentTeam1").val(teamId);
     } else {
          $.each(teamArr, function (index, value) {
               $("#team1-" + value).css("display", "none");
               $("#employee1-" + value).css("display", "none");
               $("#selectTeam1-" + value).removeClass("selectedTeam");
               $("#selectTeam1-" + value).addClass("bg-white");
               $("#team1-" + value).show();
               $("#employee1-" + value).show();
          });
          $("#currentTeam1").val("all");
     }
}
function showTeamEmployee2(teamId) {
     var teamStr = $("#allTeam2").val();
     var teamArr = teamStr.split(",");
     var currentTeam2 = $("#currentTeam2").val();
     if (teamId != currentTeam2) {
          $.each(teamArr, function (index, value) {
               if (value != "" && value != teamId) {
                    $("#team2-" + value).css("display", "none");
                    $("#employee2-" + value).css("display", "none");
                    // $("#selectTeam1-" + value).css("border", "0px");
                    $("#selectTeam2-" + value).removeClass("selectedTeam");
                    $("#selectTeam2-" + value).addClass("bg-white");
               }
          });
          $("#team2-" + teamId).show();
          $("#employee2-" + teamId).show();
          $("#selectTeam2-" + teamId).removeClass("bg-white");
          $("#selectTeam2-" + teamId).addClass("selectedTeam");
          $("#currentTeam2").val(teamId);
     } else {
          $.each(teamArr, function (index, value) {
               $("#team2-" + value).css("display", "none");
               $("#employee2-" + value).css("display", "none");
               $("#selectTeam2-" + value).removeClass("selectedTeam");
               $("#selectTeam2-" + value).addClass("bg-white");
               $("#team2-" + value).show();
               $("#employee2-" + value).show();
          });
          $("#currentTeam2").val("all");
     }
}
function showTeamEmployeeUpdate(teamId, kgiId, month, year, kgiTeamHistoryId) {
     var currentSelect = $("#currentSelect").val();
     if (kgiTeamHistoryId != currentSelect) {
          $("#historyMonthYear-" + currentSelect).removeClass("selectedTeam");
          $("#historyMonthYear-" + currentSelect).addClass("bg-white");

          $("#historyMonthYear-" + kgiTeamHistoryId).removeClass("bg-white");
          $("#historyMonthYear-" + kgiTeamHistoryId).addClass("selectedTeam");

          $("#img-" + currentSelect).attr("src", $url + "images/icons/pim/doubleplay-black.svg");
          $("#btn-" + currentSelect).removeClass("doubleplay-btn-blue");
          $("#btn-" + currentSelect).addClass("doubleplay-btn");

          $("#img-" + kgiTeamHistoryId).attr("src", $url + "images/icons/pim/doubleplay-white.svg");
          $("#btn-" + kgiTeamHistoryId).removeClass("doubleplay-btn");
          $("#btn-" + kgiTeamHistoryId).addClass("doubleplay-btn-blue");

          var url = $url + "kgi/kgi-personal/kgi-each-team-employee";
          $.ajax({
               type: "POST",
               dataType: "json",
               url: url,
               data: { kgiId: kgiId, teamId: teamId, year: year, month: month },
               success: function (data) {
                    if (data.status) {
                         $("#kgi-employee").html(data.employeeHistory);
                    }
               },
          });
          $("#currentSelect").val(kgiTeamHistoryId);
     }
}
function showFirstTeamEmployeeUpdate(teamId, kgiId, month, year, kgiTeamHistoryId) {
     var currentSelect = kgiTeamHistoryId;
     $("#historyMonthYear-" + currentSelect).removeClass("selectedTeam");
     $("#historyMonthYear-" + currentSelect).addClass("bg-white");

     $("#historyMonthYear-" + kgiTeamHistoryId).removeClass("bg-white");
     $("#historyMonthYear-" + kgiTeamHistoryId).addClass("selectedTeam");

     $("#img-" + currentSelect).attr("src", $url + "images/icons/pim/doubleplay-black.svg");
     $("#btn-" + currentSelect).removeClass("doubleplay-btn-blue");
     $("#btn-" + currentSelect).addClass("doubleplay-btn");

     $("#img-" + kgiTeamHistoryId).attr("src", $url + "images/icons/pim/doubleplay-white.svg");
     $("#btn-" + kgiTeamHistoryId).removeClass("doubleplay-btn");
     $("#btn-" + kgiTeamHistoryId).addClass("doubleplay-btn-blue");

     var url = $url + "kgi/kgi-personal/kgi-each-team-employee";
     $.ajax({
          type: "POST",
          dataType: "json",
          url: url,
          data: { kgiId: kgiId, teamId: teamId, year: year, month: month },
          success: function (data) {
               if (data.status) {
                    $("#kgi-employee").html(data.employeeHistory);
               }
          },
     });
     $("#currentSelect").val(kgiTeamHistoryId);
}
function ShowEmployeeUpdating(kgiEmployeeId) {
     var idStr = $("#allKgiEmployeeId").val();
     var idArr = idStr.split(",");

     $.each(idArr, function (index, value) {
          $("#history-" + value).hide();
          $("#main-" + value).hide();
     });
     $("#history-" + kgiEmployeeId).show();
}
function backUpdatingKgiEmployee(kgiEmployeeId) {
     var idStr = $("#allKgiEmployeeId").val();
     var idArr = idStr.split(",");
     $.each(idArr, function (index, value) {
          $("#main-" + value).show();
     });
     $("#history-" + kgiEmployeeId).hide();
}
