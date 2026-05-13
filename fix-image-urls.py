import re
from pathlib import Path
root = Path('resources/views')
replacements = [
    (re.compile(r'src="/images/([^"]+)"'), r'src="{{ asset(\'images/\1\') }}"'),
    (re.compile(r'src="\./images/([^"]+)"'), r'src="{{ asset(\'images/\1\') }}"'),
    (re.compile(r"src='/images/([^']+)'"), r"src='{{ asset(\'images/\1\') }}'"),
    (re.compile(r"src='\./images/([^']+)'"), r"src='{{ asset(\'images/\1\') }}'"),
    (re.compile(r"image:\s*'/images/([^']+)'"), r"image: '{{ asset(\"images/\1\") }}'"),
    (re.compile(r"image:\s*'\./images/([^']+)'"), r"image: '{{ asset(\"images/\1\") }}'"),
    (re.compile(r"'image'\s*=>\s*'/images/([^']+)'"), r"'image' => asset('images/\1')"),
    (re.compile(r"'image'\s*=>\s*'\./images/([^']+)'"), r"'image' => asset('images/\1')"),
    (re.compile(r"'logo'\s*=>\s*'/images/([^']+)'"), r"'logo' => asset('images/\1')"),
    (re.compile(r"'logo'\s*=>\s*'\./images/([^']+)'"), r"'logo' => asset('images/\1')"),
    (re.compile(r"'countryFlag'\s*=>\s*'/images/([^']+)'"), r"'countryFlag' => asset('images/\1')"),
    (re.compile(r"'countryFlag'\s*=>\s*'\./images/([^']+)'"), r"'countryFlag' => asset('images/\1')"),
    (re.compile(r"'userImage'\s*=>\s*'/images/([^']+)'"), r"'userImage' => asset('images/\1')"),
    (re.compile(r"'userImage'\s*=>\s*'\./images/([^']+)'"), r"'userImage' => asset('images/\1')"),
    (re.compile(r"'flag'\s*=>\s*'/images/([^']+)'"), r"'flag' => asset('images/\1')"),
    (re.compile(r"'flag'\s*=>\s*'\./images/([^']+)'"), r"'flag' => asset('images/\1')"),
    (re.compile(r"img src=\"\./images/([^"]+)\""), r"img src=\"{{ asset('images/\1') }}\""),
    (re.compile(r"img src='\./images/([^']+)'"), r"img src='{{ asset('images/\1') }}'"),
]
changed = []
for path in root.rglob('*.blade.php'):
    text = path.read_text(encoding='utf-8')
    original = text
    for pat, rep in replacements:
        text = pat.sub(rep, text)
    if text != original:
        path.write_text(text, encoding='utf-8')
        changed.append(path)
print(f'changed {len(changed)} files')
for p in changed:
    print(p)
