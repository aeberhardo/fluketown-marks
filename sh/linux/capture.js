var page = require('webpage').create(),
    system = require('system'),
    address, output;

if (system.args.length != 3) {
    console.log('Usage: capture.js URL filename');
    phantom.exit(1);
} else {
    address = system.args[1];
    output = system.args[2];
    
    page.viewportSize = { width: 1280, height: 720 };
    
    page.clipRect = { top: 0, left: 0, width: 1280, height: 720 };

    page.open(address, function (status) {
    
        if (status !== 'success') {
            console.log('Unable to load the address!');
            phantom.exit();
        } else {
            window.setTimeout(function () {
                page.render(output);
                phantom.exit();
            }, 1000);
        }

    });
}
