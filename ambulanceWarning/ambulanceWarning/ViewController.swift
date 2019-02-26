//
//  ViewController.swift
//  ambulanceWarning
//
//  Created by Charly Maxter on 26/02/2019.
//  Copyright © 2019 nbtech. All rights reserved.
//

import UIKit
import Foundation
import AVFoundation

var player: AVAudioPlayer?


class ViewController: UIViewController {
    @IBOutlet var myView:UIView!
    override func viewDidLoad() {
        super.viewDidLoad()
        switch AVAudioSession.sharedInstance().recordPermission {
        case AVAudioSession.RecordPermission.granted:
            print("Permission granted")
        case AVAudioSession.RecordPermission.denied:
            print("Pemission denied")
        case AVAudioSession.RecordPermission.undetermined:
            print("Request permission here")
            AVAudioSession.sharedInstance().requestRecordPermission({ (granted) in
                // Handle granted
            })
        }

        // Do any additional setup after loading the view, typically from a nib.
        DispatchQueue.main.asyncAfter(deadline: .now() + 10.0) {
            print("10Secs")
            self.changeColor()
            self.playSound()
            
            DispatchQueue.main.asyncAfter(deadline: .now() + 15.0) {
                self.myView.layer.removeAllAnimations()
                self.myView.backgroundColor = .white
            }
        }
    }
    func playSound() {
        var cont = 0
        guard let url = Bundle.main.url(forResource: "soundName", withExtension: "mp3") else { return }
        
        do {
            try AVAudioSession.sharedInstance().setCategory(.playback, mode: .default)
            try AVAudioSession.sharedInstance().setActive(true)
            
            /* The following line is required for the player to work on iOS 11. Change the file type accordingly*/
            player = try AVAudioPlayer(contentsOf: url, fileTypeHint: AVFileType.mp3.rawValue)
            
            /* iOS 10 and earlier require the following line:
             player = try AVAudioPlayer(contentsOf: url, fileTypeHint: AVFileTypeMPEGLayer3) */
            
            guard let player = player else { return }
            player.numberOfLoops = 2
            player.play()
            
        } catch let error {
            print(error.localizedDescription)
        }
    }
    
    func changeColor(){
        UIView.animate(withDuration: 0.5, delay: 0.0, options:[.repeat, .autoreverse], animations: {
            
            self.myView.backgroundColor = .red
        }, completion:nil)
    }

}

