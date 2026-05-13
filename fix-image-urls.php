<?php
$root = new RecursiveDirectoryIterator(__DIR__ . '/resources/views');
$iter = new RecursiveIteratorIterator($root);
$patterns = [
    '/src="\/images\/([^"]+)"/' => 'src="{{ asset(\'images/\1\') }}"',
    '/src="\.\/images\/([^"]+)"/' => 'src="{{ asset(\'images/\1\') }}"',
    '/src=\'\/images\/([^\']+)\'/' => 'src=\'{{ asset(\'images/\1\') }}\'',
    '/src=\'\.\/images\/([^\']+)\'/' => 'src=\'{{ asset(\'images/\1\') }}\'',
    '/image:\s*\'\/images\/([^\']+)\'/' => 'image: \'{{ asset("images/\1") }}\'',
    '/image:\s*\'\.\/images\/([^\']+)\'/' => 'image: \'{{ asset("images/\1") }}\'',
    '/\'image\'\s*=>\s*\'\/images\/([^\']+)\'/' => '\'image\' => asset(\'images/\1\')',
    '/\'image\'\s*=>\s*\'\.\/images\/([^\']+)\'/' => '\'image\' => asset(\'images/\1\')',
    '/\'logo\'\s*=>\s*\'\/images\/([^\']+)\'/' => '\'logo\' => asset(\'images/\1\')',
    '/\'logo\'\s*=>\s*\'\.\/images\/([^\']+)\'/' => '\'logo\' => asset(\'images/\1\')',
    '/\'countryFlag\'\s*=>\s*\'\/images\/([^\']+)\'/' => '\'countryFlag\' => asset(\'images/\1\')',
    '/\'countryFlag\'\s*=>\s*\'\.\/images\/([^\']+)\'/' => '\'countryFlag\' => asset(\'images/\1\')',
    '/\'userImage\'\s*=>\s*\'\/images\/([^\']+)\'/' => '\'userImage\' => asset(\'images/\1\')',
    '/\'userImage\'\s*=>\s*\'\.\/images\/([^\']+)\'/' => '\'userImage\' => asset(\'images/\1\')',
    '/\'flag\'\s*=>\s*\'\/images\/([^\']+)\'/' => '\'flag\' => asset(\'images/\1\')',
    '/\'flag\'\s*=>\s*\'\.\/images\/([^\']+)\'/' => '\'flag\' => asset(\'images/\1\')',
    '/img src="\.\/images\/([^"]+)"/' => 'img src="{{ asset(\'images/\1\') }}"',
    '/img src=\'\.\/images\/([^\']+)\'/' => 'img src=\'{{ asset(\'images/\1\') }}\'',
];
$changed = [];
foreach ($iter as $file) {
    if (!$file->isFile()) continue;
    if ($file->getExtension() !== 'php') continue;
    $path = $file->getPathname();
    if (strpos($path, DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR) === false) continue;
    $content = file_get_contents($path);
    $original = $content;
    foreach ($patterns as $pattern => $replacement) {
        $content = preg_replace($pattern, $replacement, $content);
    }
    if ($content !== $original) {
        file_put_contents($path, $content);
        $changed[] = $path;
    }
}
echo 'changed ' . count($changed) . " files\n";
foreach ($changed as $path) {
    echo $path . "\n";
}
