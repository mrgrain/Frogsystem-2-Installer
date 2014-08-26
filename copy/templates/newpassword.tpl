<h2>Neue Zugangsdaten anfordern</h2>

<p>Wenn du dein Passwort oder Benutzernamen vergessen hast, kannst du hier neue Zugangdaten anfordern. Wir ben&ouml;tigen dazu nur die E-Mail-Adresse, mit der du dich bei uns registriert hast.</p>

<form action="" method="post">
  <input type="hidden" name="go" value="login">
  <input type="hidden" name="newpassword" value="">

  <table border="0" cellpadding="2" cellspacing="0">
    <tr>
      <td align="left" colspan="2">
        <label for="newpassword_mail"><b>E-Mail-Adresse:</b></label>
      </td>
    </tr>
    <tr>
      <td align="left">
        <input class="input input_highlight" size="33" type="text" id="newpassword_mail" name="newpassword_mail" maxlength="50">
      </td>
      <td align="center">
        <button class="pointer" type="submit"><img src="$VAR(style_icons)user/mail.gif" alt="" align="bottom"> Neue Zugangsdaten anfordern</button>
      </td>
    </tr>
  </table>
</form>
<p>Falls du keinen Zugriff mehr auf diese E-Mail-Adresse haben solltest, musst du dir leider einen <a href="$URL(register)">neuen Account</a> anlegen.</p>
