�@Line�F�B�o�^
�E���LURL����Line�F�B�o�^�����肢���܂��B
�@https://line.me/R/ti/p/e3RfTtb-9B#~
�E���O�����b�Z�[�W���͂��āA���[�U�o�^���s���܂��B

�A�ݒ�y�[�W
�@https://command-delivery.herokuapp.com/setting.php
�E���[�U���A���M�L���Ȃǐݒ�ύX������A�X�V�{�^���Ŕ��f���܂��B
�E�s�v�ȃ��[�U�͍폜�{�^������폜�\�ł��B
�E�u���b�Z�[�W���M�v�{�^���ł́A
�@���M�`�F�b�N�������Ă��郆�[�U�Ƀe�X�g���b�Z�[�W�𑗂�܂��B

�����̃��[�U�ݒ���́AJSON�t�@�C���ɕۑ�����Ă��܂��B
�@https://command-delivery.herokuapp.com/userinfo.json

�BAI�X�s�[�J�ŃR�}���h���M
�E�ݒ�y�[�W�Őݒ肵�����[�U�ɑ΂��āA�������e�𑗐M���܂��B

�CURL�����Ƀ��b�Z�[�W�w��ŃR�}���h���M
�Ehttps://command-delivery.herokuapp.com/sendMessage.php/?msg=�e�X�g���b�Z�[�W
�@���������w�肳��Ă��Ȃ��ꍇ�́A�B�̃R�}���h�𑗐M���܂��B
�@���V�[�P���T����A���[���擾���ɁA���s���Ă��������B


���R�}���h���M�̎g�p�v���t�����ƃt�@�C���ihttps://command-delivery.herokuapp.com�j

�y�g�p�v���O�����z
�Eindex.php
�@LINE�A�v���̃��C���v���O�����B
�@���[�U���o�^���s���APC�Ƀ��b�Z�[�W�𑗂�B
�@���[�U���Fuserinfo.json
�@LINE���b�Z�[�W���e�FuserMsg.json

�EclearLineMsg.php
�@LINE���瑗��ꂽ���b�Z�[�W���e�iuserMsg.json�j���N���A����B
�@
�EclearVoiceMsg.php
�@AI�X�s�[�J���瑗��ꂽ���b�Z�[�W���e�iinput.json�j���N���A����B
�@�����ڏ����ꂽ�t�@�C���iinput.txt�j�͕ʃT�[�o�ׁ̈A�N���A�s�B

�EpushMessage.php
�@AI�X�s�[�J���瑗��ꂽ���b�Z�[�W�����[�U�ɑ��M����B
�@���b�Z�[�W���e�̃R�s�[���쐬�B
�@AI�X�s�[�J���b�Z�[�W���e�Finput.json

�EsendMessage.php
�@�����œn���ꂽ���b�Z�[�W�����[�U�ɑ��M����B
�@���������Ȃ���΁AAI�X�s�[�J���b�Z�[�W���e�𑗐M�B

�Esetting.php
�@Web�y�[�W�Ń��[�U����ҏW����B
�@
�y�g�p�t�@�C���z
�Euserinfo.json
�@���[�U���
�@LINE���[�UID�A���[�U���A���M�L���t���O
�@{"LINE���[�UID":{"userName":"���[�U��","delivery":1}

�Einput.json
�@AI�X�s�[�J���b�Z�[�W���e
�@{"SpeakerMsg":"abc"}

�EuserMsg.json
�@LINE���b�Z�[�W���e
�@{"LINE���[�UID":{"msg":"�������܂���"}}

