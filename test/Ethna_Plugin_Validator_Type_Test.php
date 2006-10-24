<?php
/**
 *  Ethna_Plugin_Validator_Type_Test.php
 */

/**
 *  Ethna_Plugin_Validator_Type���饹�Υƥ��ȥ�����
 *
 *  @access public
 */
class Ethna_Plugin_Validator_Type_Test extends UnitTestCase
{
    function testCheckValidatorType()
    {
		$ctl =& Ethna_Controller::getInstance();
		$plugin =& $ctl->getPlugin();
		$vld = $plugin->getPlugin('Validator', 'Type');

		$form_int = array(
						  'type'          => VAR_TYPE_INT,
						  'required'      => true,
						  'error'         => '{form}�ˤϿ���(����)�����Ϥ��Ʋ�����'
						  );
		$vld->af->setDef('namae_int', $form_int);

		$pear_error = $vld->validate('namae_int', 10, $form_int);
		$this->assertFalse(is_a($pear_error, 'PEAR_Error'));

		$pear_error = $vld->validate('namae_int', '', $form_int);
		$this->assertFalse(is_a($pear_error, 'PEAR_Error'));

		$pear_error = $vld->validate('namae_int', '76', $form_int);
		$this->assertFalse(is_a($pear_error, 'PEAR_Error'));

		// �����ʳ���ʸ�������Ϥ��줿
		$pear_error = $vld->validate('namae_int', '11asd', $form_int);
		$this->assertTrue(is_a($pear_error, 'PEAR_Error'));
		$this->assertEqual(E_FORM_WRONGTYPE_INT, $pear_error->getCode());
		$this->assertEqual($form_int['error'], $pear_error->getMessage());

		// �����ʳ���ʸ�������Ϥ��줿
		$pear_error = $vld->validate('namae_int', '7.6', $form_int);
		$this->assertTrue(is_a($pear_error, 'PEAR_Error'));
		$this->assertEqual(E_FORM_WRONGTYPE_INT, $pear_error->getCode());
		$this->assertEqual($form_int['error'], $pear_error->getMessage());



		$form_float = array(
							'type'          => VAR_TYPE_FLOAT,
							'required'      => true,
							'error'         => '{form}�ˤϿ���(����)�����Ϥ��Ʋ�����'
							);
		$vld->af->setDef('namae_float', $form_float);

		$pear_error = $vld->validate('namae_float', 10.1, $form_float);
		$this->assertFalse(is_a($pear_error, 'PEAR_Error'));

		$pear_error = $vld->validate('namae_float', 10, $form_float);
		$this->assertFalse(is_a($pear_error, 'PEAR_Error'));

		$pear_error = $vld->validate('namae_float', '', $form_float);
		$this->assertFalse(is_a($pear_error, 'PEAR_Error'));

		// �����ʳ���ʸ�������Ϥ��줿
		$pear_error = $vld->validate('namae_float', '1-0.1', $form_float);
		$this->assertTrue(is_a($pear_error, 'PEAR_Error'));
		$this->assertEqual(E_FORM_WRONGTYPE_FLOAT, $pear_error->getCode());
		$this->assertEqual($form_float['error'], $pear_error->getMessage());



		$form_boolean = array(
							 'type'          => VAR_TYPE_BOOLEAN,
							 'required'      => true,
							 'error'         => '{form}�ˤ�1�ޤ���0�Τ����ϤǤ��ޤ�'
							 );
		$vld->af->setDef('namae_boolean', $form_boolean);

 		$pear_error = $vld->validate('namae_boolean', 1, $form_boolean);
		$this->assertFalse(is_a($pear_error, 'PEAR_Error'));

 		$pear_error = $vld->validate('namae_boolean', 0, $form_boolean);
		$this->assertFalse(is_a($pear_error, 'PEAR_Error'));

		$pear_error = $vld->validate('namae_boolean', '', $form_boolean);
		$this->assertFalse(is_a($pear_error, 'PEAR_Error'));

		// 0,1�ʳ���ʸ�������Ϥ��줿
 		$pear_error = $vld->validate('namae_boolean', 'aaa', $form_boolean);
		$this->assertTrue(is_a($pear_error, 'PEAR_Error'));
		$this->assertEqual(E_FORM_WRONGTYPE_BOOLEAN, $pear_error->getCode());
		$this->assertEqual($form_boolean['error'], $pear_error->getMessage());

		// 0,1�ʳ���ʸ�������Ϥ��줿
		$pear_error = $vld->validate('namae_boolean', 10.1, $form_boolean);
		$this->assertTrue(is_a($pear_error, 'PEAR_Error'));
		$this->assertEqual(E_FORM_WRONGTYPE_BOOLEAN, $pear_error->getCode());
		$this->assertEqual($form_boolean['error'], $pear_error->getMessage());



		$form_datetime = array(
							   'type'          => VAR_TYPE_DATETIME,
							   'required'      => true,
							   'error'         => '{form}�ˤ����դ����Ϥ��Ʋ�����'
							   );
		$vld->af->setDef('namae_datetime', $form_datetime);

 		$pear_error = $vld->validate('namae_datetime', 0, $form_datetime);
		$this->assertFalse(is_a($pear_error, 'PEAR_Error'));

 		$pear_error = $vld->validate('namae_datetime', "+89 day", $form_datetime);
		$this->assertFalse(is_a($pear_error, 'PEAR_Error'));

 		$pear_error = $vld->validate('namae_datetime', "", $form_datetime);
		$this->assertFalse(is_a($pear_error, 'PEAR_Error'));

		// ���դ��Ѵ��Ǥ��ʤ�ʸ�������Ϥ��줿
 		$pear_error = $vld->validate('namae_datetime', "aa", $form_datetime);
		$this->assertTrue(is_a($pear_error, 'PEAR_Error'));
		$this->assertEqual(E_FORM_WRONGTYPE_DATETIME, $pear_error->getCode());
		$this->assertEqual($form_datetime['error'], $pear_error->getMessage());

		// ���դ��Ѵ��Ǥ��ʤ�ʸ�������Ϥ��줿
 		$pear_error = $vld->validate('namae_datetime', "+8", $form_datetime);
		$this->assertTrue(is_a($pear_error, 'PEAR_Error'));
		$this->assertEqual(E_FORM_WRONGTYPE_DATETIME, $pear_error->getCode());
		$this->assertEqual($form_datetime['error'], $pear_error->getMessage());

	}
}
?>