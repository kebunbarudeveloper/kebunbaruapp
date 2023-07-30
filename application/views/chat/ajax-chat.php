
    <?php
    $user = $this->session->userdata('username_user');
    if ($data) {
        foreach ($data as $row) {
            $userto = $row->user_to;

            if ($userto == $user) {
                $tempalate = '<div class="direct-chat-msg">
            <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-left"></span>
                <span class="direct-chat-timestamp float-right"></span>
            </div>
            <!-- /.direct-chat-infos -->
            <img class="direct-chat-img" src="' . base_url('assets/chat/') . $row->user_from . '.png" alt="Message User Image">
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text">
                <span class="emoji">' . $row->message . '</span><br><span class="time" style="font-size: 6pt">' . $row->created . '</span>
            </div>
        </div>';
            } else {
                $tempalate = '<div class="direct-chat-msg right">
            <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-right"></span>
                <span class="direct-chat-timestamp float-left"></span>
            </div>
            <!-- /.direct-chat-infos -->
            <img class="direct-chat-img" src="' . base_url('assets/chat/') . $row->user_from . '.png" alt="Message User Image">
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text">
            <span class="emoji">' . $row->message . '</span><br><span class="time" style="font-size: 6pt">' . $row->created . '</span>
            </div>
            <!-- /.direct-chat-text -->
        </div>';
            }
    ?>

            <?= $tempalate ?>

    <?php
        }
    }

    ?>
    