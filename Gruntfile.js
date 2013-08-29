module.exports = function(grunt) {
  grunt.initConfig({
    compress: {
        template: {
            options: {
                archive: '../extensions/wright.zip'
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
    }
  });
  
  grunt.loadNpmTasks('grunt-contrib-compress');
  
  grunt.registerTask('default', ['compress']);
};

