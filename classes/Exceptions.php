<?php
/**
 * @file     Exceptions.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * this file contains all special fs2-installer exceptions
 */


/**
 * This Exception is used for errors in forms filled by a user.
 */
class InstructionNotFoundException extends Exception { };
class CheckerTestFailedException extends Exception { };
class NoDatabaseConnectionException extends Exception { };
class FileOperationException extends Exception { };
class TemplateOperationException extends Exception { };

?>
