module.exports = function(grunt) {
  grunt.initConfig({
    compress: {
        template: {
            options: {
                archive: '../otc/wright.zip'
            },
            
            files: [
                {cwd: 'wright/', src: ['**/*'], expand: true, dest: ''}, // includes files in path and its subdirs
            ]
        },
        
        com_otc: {
            options: {
                archive: '../otc/com_otc.zip'
            },
            
            files: [
                {cwd: 'com_otc/', src: ['**/*'], expand: true, dest: ''}, // includes files in path and its subdirs
            ]
        },
        
        mod_otcmenu: {
            options: {
                archive: '../otc/mod_otcmenu.zip'
            },
            
            files: [
                {cwd: 'mod_otcmenu/', src: ['**/*'], expand: true, dest: ''}, // includes files in path and its subdirs
            ]
        }
    },
    
    exec: {
        test: {
            cmd: "find . -type f -name '*.php' -exec php -l {} ;",
            
            onOutData: function (data) {
                console.log(data);
                
                if (data.match(/Errors parsing|PHP Parse error/g)) {
                    process.exit(1);
                }
            },
        
            onErrData: function (data) {
                console.error(data);
                
                if (data.match(/Errors parsing|PHP Parse error/g)) {
                    process.exit(1);
                }
            }
        },
        
        clean: {
            cmd: 'find . -type f -name "*~" -exec rm -f {} ;'
        }
    }
  });
  
  grunt.loadNpmTasks('grunt-contrib-compress');
  grunt.loadNpmTasks('grunt-exec');
  
  grunt.registerTask('default', ['exec:test', 'compress']);
  grunt.registerTask('clean', ['exec:clean']);
  grunt.registerTask('test', ['exec:test']);
};

