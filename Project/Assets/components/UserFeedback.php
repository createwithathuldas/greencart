<?php

if (isset($_POST['btn_feedback_submit'])) {
    date_default_timezone_set('Asia/Kolkata');
    $user_feedback_content = $_POST['txt_feedback_content'];
    $user_feedback_face = $_POST['radio_feedback_rating'];
    $user_feedback_time = date('Y-m-d H:i:s');
    $insQuery = "insert into tbl_feedback(feedback_content,feedback_rating,feedback_time,user_id) 
values('$user_feedback_content',$user_feedback_face,'$user_feedback_time'," . $data['user_id'] . ")";

    if ($conn->query($insQuery)) {
        ?>
        <script>
            alert('Thanks for your feedback')
            window.location = './UserHomePage.php'
        </script>
        <?php
    }
}

?>

<form id="feedback-form-wrapper" method="post">
    <div id="feedback-form-modal">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="border: none;">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: #548302;font-size: 24pt;">Feedback
                        </h5>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <div class="rating-input-wrapper d-flex justify-content-between mt-2">
                                    <label><input type="radio" name="radio_feedback_rating" value="0"
                                            required /><span class="px-3 py-2"
                                            style="font-size: 34pt;">&#128577;</span></label>
                                    <label><input type="radio" name="radio_feedback_rating" value="1"
                                            required /><span class="px-3 py-2"
                                            style="font-size: 34pt;">&#128528;</span></label>
                                    <label><input type="radio" name="radio_feedback_rating" value="2"
                                            required /><span class="px-3 py-2"
                                            style="font-size: 34pt;">&#128578;</span></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <br>
                                <label for="input-two">Would you like to say something?</label>
                                <textarea class="form-control" id="input-two" rows="3" style="background: none;"
                                    name="txt_feedback_content" required></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer" style="border: none;">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="btn_feedback_submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


