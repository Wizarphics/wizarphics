<?php

use wizarphics\wizarframework\Application;

$error_id = uniqid('error', true);
$title = esc($exception->getMessage());


?>
<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="robots" content="noindex">

	<title><?= esc($title) ?></title>
	<style type="text/css">
		<?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.css')) ?><?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'prism.css')) ?>.ASKPHP__trademark {
			position: absolute;
			bottom: 25px;
			right: 25px;
			text-decoration: none;
			font-size: 18px;
			display: flex;
			align-items: center;
			font-weight: normal;
			gap: .3rem;
			color: #efefef;
		}

		details>summary>p {
			list-style-type: none;
			cursor: pointer;
			font-weight: 700;
		}

		details>summary>p::before {
			content: '=';
		}

		details>summary>p:hover {
			background-color: #f00;
		}

		.tabs {
			margin-bottom: 1rem;
		}

		.tabs a:link,
		.tabs a:visited {
			border-radius: .125rem;
		}
	</style>

	<script type="text/javascript">
		<?= file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.js') ?>
		<?= file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'prism.js') ?>
	</script>
</head>

<body onload="init()">

	<a class="ASKPHP__trademark" href="<?= FRAME_WORK_URL ?>">
		<img src="/images/Icon.png" alt="WizarFrameWork" height="30px">
		AskPHP
	</a>
	<!-- Header -->
	<div class="header">
		<div class="container">
			<h1><?= esc($title), esc($exception->getCode() ? ' #' . $exception->getCode() : '') ?></h1>
			<p>
				<?= nl2br(esc($exception->getMessage())) ?>
				<a href="https://www.duckduckgo.com/?q=<?= urlencode($title . ' ' . preg_replace('#\'.*\'|".*"#Us', '', $exception->getMessage())) ?>" rel="noreferrer" target="_blank">search &rarr;</a>
			</p>
		</div>
	</div>

	<div class="container">

		<ul class="tabs" id="tabs">
			<li><a href="#backtrace">Backtrace</a></li>
			<li><a href="#server">Server</a></li>
			<li><a href="#request">Request</a></li>
			<li><a href="#response">Response</a></li>
			<li><a href="#files">Files</a></li>
			<li><a href="#memory">Memory</a></li>
		</ul>

		<div class="tab-content" style="background-color: #343a40;">

			<!-- Backtrace -->
			<div class="content" id="backtrace">

				<ol class="trace">
					<?php $index = 0;
					$file = $exception->getFile();
					$line = $exception->getLine();
					$class = get_class($exception);
					$function = strpos($class, '::') ? strstr($class, '::') : null;
					?>
					<li>
						<details open>
							<summary da="&amp;">
								<!-- Trace info -->
								<?php if (isset($file) && is_file($file)) : ?>
									<?php
									if (isset($function) && in_array($function, ['include', 'include_once', 'require', 'require_once'], true)) {
										echo esc($function . ' ' . clean_path($file));
									} else {
										echo esc(clean_path($file) . ' : ' . $line);
									}
									?>
								<?php else : ?>
									{PHP internal code}
								<?php endif; ?>
							</summary>

							<!-- Source? -->
							<?php if (isset($file) && is_file($file) && isset($class)) : ?>
								<?= static::highlightFile($file, $line) ?>
							<?php endif; ?>
						</details>
					</li>
					<?php
					foreach ($trace as $index => $row) : ?>
						<li>
							<details aria-expanded="true">
								<summary>
									<!-- Trace info -->
									<?php if (isset($row['file']) && is_file($row['file'])) : ?>
										<?php
										if (isset($row['function']) && in_array($row['function'], ['include', 'include_once', 'require', 'require_once'], true)) {
											echo esc($row['function'] . ' ' . clean_path($row['file']));
										} else {
											echo esc(clean_path($row['file']) . ' : ' . $row['line']);
										}
										?>
									<?php else : ?>
										{PHP internal code}
									<?php endif; ?>

									<!-- Class/Method -->
									<?php if (isset($row['class'])) : ?>
										&nbsp;&nbsp;&mdash;&nbsp;&nbsp;<?= esc($row['class'] . $row['type'] . $row['function']) ?>
										<?php if (!empty($row['args'])) : ?>
											<?php $args_id = $error_id . 'args' . $index ?>
											( <a href="#" onclick="return toggle('<?= esc($args_id, 'attr') ?>');">arguments</a> )
											<div class="args" id="<?= esc($args_id, 'attr') ?>">
												<table cellspacing="0">

													<?php
													$params = null;
													// Reflection by name is not available for closure function
													if (substr($row['function'], -1) !== '}') {
														$mirror = isset($row['class']) ? new \ReflectionMethod($row['class'], $row['function']) : new \ReflectionFunction($row['function']);
														$params = $mirror->getParameters();
													}

													foreach ($row['args'] as $key => $value) : ?>
														<tr>
															<td><code><?= esc(isset($params[$key]) ? '$' . $params[$key]->name : "#{$key}") ?></code></td>
															<td>
																<pre class="language-php">
																	<code><?= esc(print_r($value, true)) ?></code>
																</pre>
															</td>
														</tr>
													<?php endforeach ?>

												</table>
											</div>
										<?php else : ?>
											()
										<?php endif; ?>
									<?php endif; ?>

									<?php if (!isset($row['class']) && isset($row['function'])) : ?>
										&nbsp;&nbsp;&mdash;&nbsp;&nbsp; <?= esc($row['function']) ?>()
									<?php endif; ?>
								</summary>

								<!-- Source? -->
								<?php if (isset($row['file']) && is_file($row['file']) && isset($row['class'])) : ?>
									<?= static::highlightFile($row['file'], $row['line']) ?>
								<?php endif; ?>
							</details>
						</li>
					<?php endforeach; ?>
				</ol>

			</div>

			<!-- Server -->
			<div class="content" id="server">
				<table>
					<tbody>
						<tr>
							<td>PHP_VERSION</td>
							<td>
								<?= PHP_VERSION ?>
							</td>
						</tr>
						<tr>
							<td>ASKPHP_VERSION</td>
							<td>
								<?= esc(Application::VERSION) ?>
							</td>
						</tr>
					</tbody>
				</table>
				<?php foreach (['_SERVER', '_SESSION'] as $var) : ?>
					<?php
					if (empty($GLOBALS[$var]) || !is_array($GLOBALS[$var])) {
						continue;
					} ?>
					<details>
						<summary>
							$<?= esc($var) ?>
						</summary>

						<table>
							<thead>
								<tr>
									<th>Key</th>
									<th>Value</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($GLOBALS[$var] as $key => $value) : ?>
									<tr>
										<td><?= esc($key) ?></td>
										<td>
											<?php if (is_string($value)) : ?>
												<?= esc($value) ?>
											<?php else : ?>
												<pre><?= esc(print_r($value, true)) ?></pre>
											<?php endif; ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</details>
				<?php endforeach ?>

				<!-- Constants -->
				<?php $constants = get_defined_constants(true); ?>
				<?php if (!empty($constants['user'])) :
					// $constants['user']['PHP_VERSION'] = phpversion();
					// $constants['user']['ASKPHP_VERSION'] = Application::VERSION;
				?>
					<details>
						<summary>
							Constants
						</summary>
						<table>
							<thead>
								<tr>
									<th>Key</th>
									<th>Value</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($constants['user'] as $key => $value) : ?>
									<tr>
										<td><?= esc($key) ?></td>
										<td>
											<?php if (is_string($value)) : ?>
												<?= esc($value) ?>
											<?php else : ?>
												<pre><?= esc(print_r($value, true)) ?></pre>
											<?php endif; ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</details>
				<?php endif; ?>
			</div>

			<!-- Request -->
			<div class="content" id="request">
				<?php $request = app()->request; ?>
				<table>
					<tbody>
						<tr>
							<td style="width: 10em">Path</td>
							<td><?= esc($request->getPath()) ?></td>
						</tr>
						<tr>
							<td>HTTP Method</td>
							<td><?= $request->Method() ?></td>
						</tr>
						<tr>
							<td>IP Address</td>
							<td><?= $request->getIPAddress() ?></td>
						</tr>
						<tr>
							<td style="width: 10em">Is AJAX Request?</td>
							<td><?= $request->isAJAX() ? 'yes' : 'no' ?></td>
						</tr>
						<tr>
							<td>Is CLI Request?</td>
							<td><?= is_cli() ? 'yes' : 'no' ?></td>
						</tr>
						<tr>
							<td>Is Secure Request?</td>
							<td><?= $request->isSecure() ? 'yes' : 'no' ?></td>
						</tr>
					</tbody>
				</table>


				<?php $empty = true; ?>
				<?php foreach (['_GET', '_POST', '_COOKIE'] as $var) : ?>
					<?php
					if (empty($GLOBALS[$var]) || !is_array($GLOBALS[$var])) {
						continue;
					} ?>

					<?php $empty = false; ?>
					<details>
						<summary>
							$<?= esc($var) ?>
						</summary>

						<table style="width: 100%">
							<thead>
								<tr>
									<th>Key</th>
									<th>Value</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($GLOBALS[$var] as $key => $value) : ?>
									<tr>
										<td><?= esc($key) ?></td>
										<td>
											<?php if (is_string($value)) : ?>
												<?= esc($value) ?>
											<?php else : ?>
												<pre><?= (printf(esc($value), true)) ?></pre>
											<?php endif; ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</details>

				<?php endforeach ?>

				<?php if ($empty) : ?>

					<div class="alert">
						No $_GET, $_POST, or $_COOKIE Information to show.
					</div>

				<?php endif; ?>

				<?php $headers = $request->headers(); ?>
				<?php if (!empty($headers)) : ?>
					<details>
						<summary>
							Headers
						</summary>
						<table>
							<thead>
								<tr>
									<th>Header</th>
									<th>Value</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($headers as $value) : ?>
									<?php
									if (empty($value)) {
										continue;
									}

									if (!is_array($value)) {
										$value = [$value];
									} ?>
									<?php foreach ($value as $h) : ?>
										<tr>
											<td><?= esc($h->getName(), 'html') ?></td>
											<td><?= esc($h->getValueLine(), 'html') ?></td>
										</tr>
									<?php endforeach; ?>
								<?php endforeach; ?>
							</tbody>
						</table>
					</details>
				<?php endif; ?>
			</div>

			<!-- Response -->
			<?php
			$response = app()->response;
			$response->setStatusCode(http_response_code());
			?>
			<div class="content" id="response">
				<table>
					<tr>
						<td style="width: 15em">Response Status</td>
						<td><?= esc($response->getStatusCode() . ' - ' . $response->getReasonPhrase()) ?></td>
					</tr>
				</table>

				<?php $headers = $response->headers(); ?>
				<?php if (!empty($headers)) : ?>
					<?php natsort($headers) ?>

					<h3>Headers</h3>

					<table>
						<thead>
							<tr>
								<th>Header</th>
								<th>Value</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($headers as $name => $value) : ?>
								<tr>
									<td><?= esc($name, 'html') ?></td>
									<td><?= esc($response->getHeaderLine($name), 'html') ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>

				<?php endif; ?>
			</div>

			<!-- Files -->
			<div class="content" id="files">
				<?php $files = get_included_files(); ?>

				<ol>
					<?php foreach ($files as $file) : ?>
						<li><?= esc(clean_path($file)) ?></li>
					<?php endforeach ?>
				</ol>
			</div>

			<!-- Memory -->
			<div class="content" id="memory">

				<table>
					<tbody>
						<tr>
							<td>Memory Usage</td>
							<td><?= esc(static::describeMemory(memory_get_usage(true))) ?></td>
						</tr>
						<tr>
							<td style="width: 12em">Peak Memory Usage:</td>
							<td><?= esc(static::describeMemory(memory_get_peak_usage(true))) ?></td>
						</tr>
						<tr>
							<td>Memory Limit:</td>
							<td><?= esc(ini_get('memory_limit')) ?></td>
						</tr>
					</tbody>
				</table>

			</div>

		</div> <!-- /tab-content -->

	</div> <!-- /container -->


</body>

</html>